
-- MANAGER
ALTER TABLE manager
  ADD PRIMARY KEY (manager_id);


-- SEGMENT
ALTER TABLE segment
  ADD PRIMARY KEY (segment_id);

-- CUSTOMER
ALTER TABLE customer
  ADD PRIMARY KEY (customer_id),
  ADD CONSTRAINT fk_customer_segment FOREIGN KEY (segment_id) REFERENCES segment(segment_id);


-- COUNTRY
ALTER TABLE country
  ADD PRIMARY KEY (country_id);

-- REGION
ALTER TABLE region
  ADD PRIMARY KEY (region_id),
  ADD CONSTRAINT fk_region_manager FOREIGN KEY (manager_id) REFERENCES manager(manager_id);

-- STATE
ALTER TABLE state
  ADD PRIMARY KEY (state_id);

-- CITY
ALTER TABLE city
  ADD PRIMARY KEY (city_id);

-- CATEGORY
ALTER TABLE category
  ADD PRIMARY KEY (category_id);

-- SUBCATEGORY
ALTER TABLE subcategory
  ADD PRIMARY KEY (subcategory_id),
  ADD CONSTRAINT fk_subcategory_category FOREIGN KEY (category_id) REFERENCES category(category_id);



-- CUSTOMER LOCATION
ALTER TABLE `customer_location`
  ADD PRIMARY KEY (cust_loc_id),
  ADD CONSTRAINT fk_custloc_customer FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
  ADD CONSTRAINT fk_custloc_location FOREIGN KEY (location_id) REFERENCES location(location_id);

-- LOCATION
ALTER TABLE location
  ADD PRIMARY KEY (location_id),
  ADD CONSTRAINT fk_location_country FOREIGN KEY (country_id) REFERENCES country(country_id),
  ADD CONSTRAINT fk_location_region FOREIGN KEY (region_id) REFERENCES region(region_id),
  ADD CONSTRAINT fk_location_state FOREIGN KEY (state_id) REFERENCES state(state_id),
  ADD CONSTRAINT fk_location_city FOREIGN KEY (city_id) REFERENCES city(city_id);



-- SHIP MODE
ALTER TABLE ship_mode
  ADD PRIMARY KEY (ship_mode_id);

-- PRODUCT
ALTER TABLE product
  ADD PRIMARY KEY (product_id),
  ADD CONSTRAINT fk_product_subcategory FOREIGN KEY (subcategory_id) REFERENCES subcategory(subcategory_id);


-- ORDERS
ALTER TABLE orders
  ADD PRIMARY KEY (order_id),
  ADD CONSTRAINT fk_orders_custloc FOREIGN KEY (cust_loc_id) REFERENCES `customer location`(cust_loc_id),
  ADD CONSTRAINT fk_orders_shipmode FOREIGN KEY (ship_mode_id) REFERENCES ship_mode(ship_mode_id);

-- ORDER DETAIL
ALTER TABLE order_detail
  ADD PRIMARY KEY (order_detail_id),
  ADD CONSTRAINT fk_orderdetail_order FOREIGN KEY (order_id) REFERENCES orders(order_id),
  ADD CONSTRAINT fk_orderdetail_product FOREIGN KEY (product_id) REFERENCES product(product_id);

-- RETURNS
ALTER TABLE returns
  ADD PRIMARY KEY (return_id),
  ADD CONSTRAINT fk_returns_order FOREIGN KEY (order_id) REFERENCES orders(order_id),
  ADD CONSTRAINT fk_returns_product FOREIGN KEY (product_id) REFERENCES product(product_id);
