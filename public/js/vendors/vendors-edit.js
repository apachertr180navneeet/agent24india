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
            thisJs.getCitiesByDistrict();
            thisJs.getSubCategories();
        },

        /**
         * Initialize components.
         */
        initializeComponents: function() {
            var $form = $('#edit-user-form');
            
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
                    maxDate: "today",
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
            var $form = $("#edit-user-form");
            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    business_name: {
                        required: true,
                        remote: {
                            url: $("#business_name").data("check-url"),
                            type: "post",
                            data: {
                                business_name: function() {
                                    return $("#business_name").val();
                                },
                                user_id: function() {
                                    return $("#user_id").val();
                                }
                            }
                        }
                    },
                    mobile: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        digits: true,
                        remote: {
                            url: $("#mobile").data("check-url"),
                            type: "post",
                            data: {
                                mobile: function() {
                                    return $("#mobile").val();
                                },
                                user_id: function() {
                                    return $("#user_id").val();
                                }
                            }
                        }
                    },
                    email: {
                        email: true,
                        required: true,
                        remote: {
                            url: $("#email").data("check-url"),
                            type: "post",
                            data: {
                                email: function() {
                                    return $("#email").val();
                                },
                                user_id: function() {
                                    return $("#user_id").val();
                                }
                            }
                        }
                    },
                    state_id:{
                        required: true
                    },
                    district_id:{
                        required: true
                    },
                    city_id:{
                        required: true
                    },
                    address:{
                        required: true
                    },
                    pincode:{
                        required: true,
                        digits: true,
                    },
                    image:{
                        required: false,
                        accept: "image/jpg, image/jpeg, image/png, image/gif"
                    },
                    category_id:{
                        required: true
                    },
                    sub_category_id:{
                        required: true
                    },
                },
                //------------------

                // @validation error messages
                messages: {
                    business_name: {
                        required: "This field is required.",
                        remote: "Business name already exists"
                    },
                    mobile: {
                        required: "This field is required.",
                        minlength: "Mobile no. must be at leat 10 digits long.",
                        maxlength: "Mobile no. cannot be more than 10 digits.",
                        digits: "Please enter valid mobile number.",
                        remote: "The mobile number already exists."
                    },
                    email: {
                        email: "Please enter a valid email.",
                        required: "This field is required.",
                        remote: "The email already exists."
                    },
                    state_id:{
                        required: "This field is required."
                    },
                    district_id:{
                        required: "This field is required."
                    },
                    city_id:{
                        required: "This field is required."
                    },
                    address:{
                        required: "This field is required."
                    },
                    pincode: {
                        required: "This field is required.",
                        digits: "Please enter valid pincode."
                    },
                    image:{
                        required: "This field is required.",
                        accept: "Only JPG, PNG and GIF files are allowed."
                    },
                    category_id:{
                        required: "This field is required.",
                    },
                    sub_category_id:{
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
        getDistrictsByState: function(){
            var $form = $("#edit-user-form");

            $form.on('change', '#state_id', function(){
                // Get size categories by selected is_grouped value
                $.ajax({
                    type: "POST",
                    url: $('#state_id').data('get-districts-url'),
                    async: true,
                    data: {state_id: $(this).val() },
                    success: function(response) {
                        // Preparing Dropdown
                        // if(response._data)
                        // {
                        //     $form.find('#agent_id').html(response._data);
                        //     $form.find('#agent_id').selectpicker('refresh');
                        // }
                        $form.find('#district_id').html(response.data);
                        $form.find('#district_id').selectpicker('refresh');
                    },
                });
            });
        },
        getCitiesByDistrict: function(){
            var $form = $("#edit-user-form");

            $form.on('change', '#district_id', function(){
                // Get size categories by selected is_grouped value
                $.ajax({
                    type: "POST",
                    url: $('#district_id').data('get-cities-url'),
                    async: true,
                    data: {district_id: $(this).val() },
                    success: function(response) {
                        // Preparing Dropdown
                        // if(response._data)
                        // {
                        //     $form.find('#agent_id').html(response._data);
                        //     $form.find('#agent_id').selectpicker('refresh');
                        // }
                        $form.find('#city_id').html(response.data);
                        $form.find('#city_id').selectpicker('refresh');
                    },
                });
            });
        },
        getSubCategories: function(){
            var $form = $("#edit-user-form");

            $form.on('change', '#category_id', function(){
                // Get size categories by selected is_grouped value
                $.ajax({
                    type: "POST",
                    url: $('#category_id').data('get-sub-categories-url'),
                    async: true,
                    data: {category_id: $(this).val() },
                    success: function(response) {
                        // Preparing Dropdown
                        // if(response._data)
                        // {
                        //     $form.find('#agent_id').html(response._data);
                        //     $form.find('#agent_id').selectpicker('refresh');
                        // }
                        $form.find('#sub_category_id').html(response.data);
                        $form.find('#sub_category_id').selectpicker('refresh');
                    },
                });
            });
        }
    };
})();

thisJs.init();