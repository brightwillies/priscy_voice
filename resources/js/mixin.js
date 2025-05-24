export const mixin = {
    methods: {


        checkpermission(id) {
            let definedpermissions = localStorage.getItem('permissions');
            if (definedpermissions) {
                if (definedpermissions.includes(id)) {
                    return true
                } else {
                    return false
                }
            } else {

                // delete axios.defaults.headers.common["Authorization"];
                // localStorage.removeItem("churchadminmask");
                // localStorage.removeItem("churchadminusername");
                // localStorage.removeItem("churchadmintoken");
                // localStorage.removeItem("permissions");
                // window.location.replace("/admin-login");
                // return false;

            }

        },


        successToastReloadPage(message) {
            const Toast = swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener("mouseenter", swal.stopTimer);
                        toast.addEventListener("mouseleave", swal.resumeTimer);
                    },
                },
                function() {}
            );

            Toast.fire({
                icon: "success",
                title: message,
            }).then(function() {

                window.location.reload();
            });

        },
        //successtoast message with redirect


        successToastRedirect(message, link) {
            const Toast = swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener("mouseenter", swal.stopTimer);
                        toast.addEventListener("mouseleave", swal.resumeTimer);
                    },
                },
                function() {}
            );

            Toast.fire({
                icon: "success",
                title: message,
            }).then(function() {

                window.location.replace(link);
            });

        },
    }
}
