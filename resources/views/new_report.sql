-- Ensure the correct database is selected
USE superstore;

-- Drop the operational_report temporary table if it exists
DROP TABLE IF EXISTS operational_report;

-- Create the operational_report temporary table
CREATE TEMPORARY TABLE operational_report (
    region_name VARCHAR(255),
    state_name VARCHAR(255),
    city_name VARCHAR(255),
    regional_manager VARCHAR(255),
    product_name VARCHAR(255),
    category_name VARCHAR(255),
    subcategory_name VARCHAR(255),
    total_sales DECIMAL(15, 2),
    total_profit DECIMAL(15, 2),
    total_quantity INT,
    report_level VARCHAR(50)
);

-- Populate the temporary table with detailed data
INSERT INTO operational_report (
    region_name, state_name, city_name, regional_manager, product_name,
    category_name, subcategory_name, total_sales, total_profit, total_quantity, report_level
)
SELECT
    r.region_name,
    s.state_name,
    c.city_name,
    m.regional_manager,
    p.product_name,
    cat.category_name,
    sc.sub_category AS subcategory_name,
    COALESCE(SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2))), 0) AS total_sales,
    COALESCE(SUM(CAST(COALESCE(od.profit, '0') AS DECIMAL(15, 2))), 0) AS total_profit,
    COALESCE(SUM(CAST(COALESCE(od.quantity, '0') AS SIGNED)), 0) AS total_quantity,
    'Detail' AS report_level
FROM orders o
JOIN customer_location cl ON o.cust_loc_id = cl.cust_loc_id
JOIN location l ON cl.location_id = l.location_id
JOIN region r ON l.region_id = r.region_id
JOIN state s ON l.state_id = s.state_id
JOIN city c ON l.city_id = c.city_id
JOIN manager m ON r.manager_id = m.manager_id
JOIN order_detail od ON o.order_id = od.order_id
JOIN product p ON od.product_id = p.product_id
JOIN subcategory sc ON p.subcategory_id = sc.subcategory_id
JOIN category cat ON sc.category_id = cat.category_id
GROUP BY
    r.region_name, s.state_name, c.city_name, m.regional_manager,
    p.product_name, cat.category_name, sc.sub_category;

-- Add subtotals by region
INSERT INTO operational_report (
    region_name, state_name, city_name, regional_manager, product_name,
    category_name, subcategory_name, total_sales, total_profit, total_quantity, report_level
)
SELECT
    r.region_name,
    NULL AS state_name,
    NULL AS city_name,
    NULL AS regional_manager,
    NULL AS product_name,
    NULL AS category_name,
    NULL AS subcategory_name,
    COALESCE(SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2))), 0) AS total_sales,
    COALESCE(SUM(CAST(COALESCE(od.profit, '0') AS DECIMAL(15, 2))), 0) AS total_profit,
    COALESCE(SUM(CAST(COALESCE(od.quantity, '0') AS SIGNED)), 0) AS total_quantity,
    'Region Subtotal' AS report_level
FROM orders o
JOIN customer_location cl ON o.cust_loc_id = cl.cust_loc_id
JOIN location l ON cl.location_id = l.location_id
JOIN region r ON l.region_id = r.region_id
JOIN order_detail od ON o.order_id = od.order_id
GROUP BY r.region_name;

-- Add subtotals by state
INSERT INTO operational_report (
    region_name, state_name, city_name, regional_manager, product_name,
    category_name, subcategory_name, total_sales, total_profit, total_quantity, report_level
)
SELECT
    r.region_name,
    s.state_name,
    NULL AS city_name,
    NULL AS regional_manager,
    NULL AS product_name,
    NULL AS category_name,
    NULL AS subcategory_name,
    COALESCE(SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2))), 0) AS total_sales,
    COALESCE(SUM(CAST(COALESCE(od.profit, '0') AS DECIMAL(15, 2))), 0) AS total_profit,
    COALESCE(SUM(CAST(COALESCE(od.quantity, '0') AS SIGNED)), 0) AS total_quantity,
    'State Subtotal' AS report_level
FROM orders o
JOIN customer_location cl ON o.cust_loc_id = cl.cust_loc_id
JOIN location l ON cl.location_id = l.location_id
JOIN region r ON l.region_id = r.region_id
JOIN state s ON l.state_id = s.state_id
JOIN order_detail od ON o.order_id = od.order_id
GROUP BY r.region_name, s.state_name;

-- Add grand total
INSERT INTO operational_report (
    region_name, state_name, city_name, regional_manager, product_name,
    category_name, subcategory_name, total_sales, total_profit, total_quantity, report_level
)
SELECT
    NULL AS region_name,
    NULL AS state_name,
    NULL AS city_name,
    NULL AS regional_manager,
    NULL AS product_name,
    NULL AS category_name,
    NULL AS subcategory_name,
    COALESCE(SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2))), 0) AS total_sales,
    COALESCE(SUM(CAST(COALESCE(od.profit, '0') AS DECIMAL(15, 2))), 0) AS total_profit,
    COALESCE(SUM(CAST(COALESCE(od.quantity, '0') AS SIGNED)), 0) AS total_quantity,
    'Grand Total' AS report_level
FROM orders o
JOIN order_detail od ON o.order_id = od.order_id;

-- Verify operational_report creation
SELECT 'Operational Report Created' AS message, COUNT(*) AS row_count FROM operational_report;







-- Drop the executive_report temporary table if it exists
DROP TABLE IF EXISTS executive_report;

-- Create the executive_report temporary table
CREATE TEMPORARY TABLE executive_report (
    region_name VARCHAR(255),
    category_name VARCHAR(255),
    total_sales DECIMAL(15, 2),
    total_profit DECIMAL(15, 2),
    total_quantity INT,
    profit_margin DECIMAL(5, 2),
    report_level VARCHAR(50)
);

-- Populate the temporary table with aggregated data by region and category
INSERT INTO executive_report (
    region_name, category_name, total_sales, total_profit, total_quantity, profit_margin, report_level
)
SELECT
    r.region_name,
    cat.category_name,
    COALESCE(SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2))), 0) AS total_sales,
    COALESCE(SUM(CAST(COALESCE(od.profit, '0') AS DECIMAL(15, 2))), 0) AS total_profit,
    COALESCE(SUM(CAST(COALESCE(od.quantity, '0') AS SIGNED)), 0) AS total_quantity,
    CASE
        WHEN SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2))) > 0
        THEN (SUM(CAST(COALESCE(od.profit, '0') AS DECIMAL(15, 2))) / SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2)))) * 100
        ELSE 0
    END AS profit_margin,
    'Region-Category' AS report_level
FROM orders o
JOIN customer_location cl ON o.cust_loc_id = cl.cust_loc_id
JOIN location l ON cl.location_id = l.location_id
JOIN region r ON l.region_id = r.region_id
JOIN order_detail od ON o.order_id = od.order_id
JOIN product p ON od.product_id = p.product_id
JOIN subcategory sc ON p.subcategory_id = sc.subcategory_id
JOIN category cat ON sc.category_id = cat.category_id
GROUP BY r.region_name, cat.category_name;

-- Add subtotals by region
INSERT INTO executive_report (
    region_name, category_name, total_sales, total_profit, total_quantity, profit_margin, report_level
)
SELECT
    r.region_name,
    NULL AS category_name,
    COALESCE(SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2))), 0) AS total_sales,
    COALESCE(SUM(CAST(COALESCE(od.profit, '0') AS DECIMAL(15, 2))), 0) AS total_profit,
    COALESCE(SUM(CAST(COALESCE(od.quantity, '0') AS SIGNED)), 0) AS total_quantity,
    CASE
        WHEN SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2))) > 0
        THEN (SUM(CAST(COALESCE(od.profit, '0') AS DECIMAL(15, 2))) / SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2)))) * 100
        ELSE 0
    END AS profit_margin,
    'Region Subtotal' AS report_level
FROM orders o
JOIN customer_location cl ON o.cust_loc_id = cl.cust_loc_id
JOIN location l ON cl.location_id = l.location_id
JOIN region r ON l.region_id = r.region_id
JOIN order_detail od ON o.order_id = od.order_id
GROUP BY r.region_name;

-- Add grand total
INSERT INTO executive_report (
    region_name, category_name, total_sales, total_profit, total_quantity, profit_margin, report_level
)
SELECT
    NULL AS region_name,
    NULL AS category_name,
    COALESCE(SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2))), 0) AS total_sales,
    COALESCE(SUM(CAST(COALESCE(od.profit, '0') AS DECIMAL(15, 2))), 0) AS total_profit,
    COALESCE(SUM(CAST(COALESCE(od.quantity, '0') AS SIGNED)), 0) AS total_quantity,
    CASE
        WHEN SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2))) > 0
        THEN (SUM(CAST(COALESCE(od.profit, '0') AS DECIMAL(15, 2))) / SUM(CAST(COALESCE(od.sales, '0') AS DECIMAL(15, 2)))) * 100
        ELSE 0
    END AS profit_margin,
    'Grand Total' AS report_level
FROM orders o
JOIN order_detail od ON o.order_id = od.order_id;

-- Verify executive_report creation
SELECT 'Executive Report Created' AS message, COUNT(*) AS row_count FROM executive_report;

-- Query a sample of operational_report to confirm
SELECT * FROM operational_report LIMIT 10;
