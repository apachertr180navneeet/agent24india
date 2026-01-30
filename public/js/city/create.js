var thisJs = (function() {
    return {
        /**
         * Initialization.
         */
        init: function() {
            thisJs.validateForm();
            thisJs.initializeComponents();
            thisJs.customValidationMethods();
            thisJs.getDistrictsByState();
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
                    name: {
                        required: true,
                        remote: {
                            url: $("#name").data("check-url"),
                            type: "post",
                            data: {
                                name: function() {
                                    return $("#name").val();
                                },
                                state_id: function() {
                                    return $("#state_id").val();
                                },
                                district_id: function() {
                                    return $("#district_id").val();
                                }
                            }
                        }
                    },
                    state_id: {
                        required: true,
                    },
                    district_id: {
                        required: true,
                    },
                },
                //------------------

                // @validation error messages
                messages: {
                    name: {
                        required: "This field is required.",
                        remote: "The name already exists."
                    },
                    state_id: {
                        required: "This field is required.",
                    },
                    district_id: {
                        required: "This field is required.",
                    },
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
                    if($(element).hasClass('select-picker'))
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
        },

        /**
         * Get districts by selected state.
         */
        getDistrictsByState: function() {
            var $form = $("#add-form");

            // Handle form submission event
            $form.on("change", "#state_id", function() {
                $.ajax({
                    type: "POST",
                    url: $(this).data("districts-url"),
                    data: {
                        state_id: $(this).val()
                    },
                    beforeSend: function() {
                        //
                    },
                    success: function(response) {
                        console.log(response.status);
                        
                        if(response.status){
                            $("#district_id").html(response.data);
                            $("#district_id").selectpicker('refresh');
                        }
                    },
                    error: function() {},
                    complete: function() {
                        //
                    }
                });
            });
        },
    };
})();

thisJs.init();