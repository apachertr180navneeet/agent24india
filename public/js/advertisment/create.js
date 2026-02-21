var thisJs = (function() {
    return {
        /**
         * Initialization.
         */
        init: function() {
            thisJs.validateForm();
            thisJs.initializeComponents();
            thisJs.customValidationMethods();
            thisJs.bindUiRules();
        },

        /**
         * Initialize components.
         */
        initializeComponents: function() {
            var $form = $('#add-form');
            
            // Bootstrap Select
            Components.bootstrapSelect($form);
            //--------------

            // Image preview
            Components.imagePreview($form);
            //--------------

            // Description Editor
            Components.descriptionEditor($form);
            //-------------------

            // Date Range picker
            var $date_range_picker = $form.find(".date-picker");

            if ($date_range_picker.length) {
                $date_range_picker.flatpickr({
                    dateFormat: "d-m-Y",
                    // mode: "range",
                    minDate: "today",
                });
            }
            //----------------
        },

        /**
         * Custom validation methods.
         */
        customValidationMethods: function() {
            jQuery.validator.addMethod(
                "lettersOnly",
                function(value, element) {
                    return (
                        this.optional(element) ||
                        /^[a-zA-Z][a-zA-Z ]+$/i.test(value)
                    );
                },
                "Please enter only alphabets."
            );

            jQuery.validator.addMethod(
                "numericOnly",
                function(value, element) {
                    return (
                        this.optional(element) ||
                        /^[0-9]\d{0,1}(\.\d{1,2})?%?$/i.test(value)
                    );
                },
                "Please enter valid number."
            );

            jQuery.validator.addMethod(
                "uppercaseOnly",
                function(value, element) {
                    return (
                        this.optional(element) ||
                        /^[A-Z]+$/g.test(value)
                    );
                },
                "Please enter only capital letters."
            );

            jQuery.validator.addMethod(
                "emailChecker",
                function(value, element) {
                    return (
                        this.optional(element) ||
                        /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(
                            value
                        )
                    );
                },
                "Please enter a valid email address."
            );
        },

        bindUiRules: function() {
            var $typeInputs = $("input[name='type']");
            var $category = $("#category");
            var $categoryWrapper = $("#category-col");
            var $district = $("#district");
            var $districtWrapper = $("#district-col");
            var $startDate = $("#start_date");
            var $expiryDate = $("#expiry_date");
            var $form = $("#add-form");

            var getTypeValue = function() {
                return $typeInputs.filter(":checked").val() || "";
            };

            var toggleCategoryByType = function() {
                if (getTypeValue() === "district_page") {
                    $categoryWrapper.hide();
                    $category.val("").trigger("change");
                    $category.removeClass("is-invalid is-valid");
                    $category.closest(".form-group").find("span.invalid-feedback").remove();
                } else {
                    $categoryWrapper.show();
                }

                $districtWrapper.show();
            };

            var clearTypeError = function() {
                $("#type-wrapper").find("span.invalid-feedback").remove();
                $typeInputs.removeClass("is-invalid");
            };

            var updateConditionalValidation = function() {
                if (!$form.data("validator")) {
                    return;
                }
                $form.validate().element("input[name='type']");
                if (getTypeValue() === "district_page") {
                    $form.validate().element("#district");
                    clearTypeError();
                } else {
                    $form.validate().element("#category");
                    clearTypeError();
                }
            };

            var formatDate = function(date) {
                var month = String(date.getMonth() + 1).padStart(2, "0");
                var day = String(date.getDate()).padStart(2, "0");
                return date.getFullYear() + "-" + month + "-" + day;
            };

            var setExpiryAfterOneMonth = function() {
                var startValue = $startDate.val();
                if (!startValue) {
                    return;
                }

                var baseDate = new Date(startValue);
                if (isNaN(baseDate.getTime())) {
                    return;
                }

                var newDate = new Date(baseDate);
                newDate.setMonth(newDate.getMonth() + 1);
                $expiryDate.val(formatDate(newDate));
            };

            $typeInputs.on("change", function() {
                toggleCategoryByType();
                updateConditionalValidation();
            });

            $startDate.on("change", function() {
                setExpiryAfterOneMonth();
            });

            toggleCategoryByType();
            if ($startDate.val() && !$expiryDate.val()) {
                setExpiryAfterOneMonth();
            }
        },

        /**
         * Validate country form.
         */
        validateForm: function() {
            var $form = $("#add-form");
            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    start_date: {
                        required: true,
                    },
                    vendor_user_id: {
                        required: true,
                    },
                    type: {
                        required: true,
                    },
                    home_city: {
                        required: true,
                    },
                    image_alt: {
                        required: true,
                    },
                    sub_type: {
                        required: true,
                    },
                    expiry_date: {
                        required: false,
                    },
                    image: {
                        required: false,
                        accept: "image/jpg, image/jpeg, image/png, image/gif"
                    }
                },
                //------------------

                // @validation error messages
                messages: {
                    start_date: {
                        required: "This field is required.",
                    },
                    vendor_user_id: {
                        required: "This field is required.",
                    },
                    type: {
                        required: "This field is required.",
                    },
                    home_city: {
                        required: "This field is required.",
                    },
                    image_alt: {
                        required: "This field is required.",
                    },
                    sub_type: {
                        required: "This field is required.",
                    },
                    expiry_date: {
                        required: "This field is required.",
                    },
                    image:{
                        required: "This field is required.",
                        accept: "Only JPG, PNG and GIF files are allowed."
                    }
                },
                //---------------------------

                highlight: function(element, errorClass, validClass) {
                    $(element)
                        .closest(".form-group")
                        .addClass("has-danger")
                        .removeClass("has-success");
                    $(element)
                        .addClass("is-invalid")
                        .removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element)
                        .closest(".form-group")
                        .addClass("has-success")
                        .removeClass("has-danger");
                    $(element)
                        .addClass("is-valid")
                        .removeClass("is-invalid");
                },
                errorPlacement: function(error, element) {
                    if($(element).attr("name") === "type")
                    {
                        error.appendTo($("#type-wrapper"));
                    }
                    else if($(element).hasClass('select-picker'))
                    {
                        $(element).on('change', function(){
                            $(this).valid();
                        });
                        
                        error.appendTo($(element).parent().parent());
                    }
                    else if($(element).hasClass('image-preview'))
                    {
                        error.appendTo($(element).parents('.dropify-wrapper').parent());
                    }
                    else
                    {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    App.formLoading($form);
                    form.submit();
                }
            });
        }
    };
})();

thisJs.init();
