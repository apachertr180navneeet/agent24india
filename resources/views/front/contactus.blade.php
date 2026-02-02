@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
@endpush

@section('content')
    <section class="contact-section">
      <div class="container">
        <div class="row">

            <!-- RIGHT INFO -->
            <div class="contact-info  col-lg-6 col-12 ">
            <h3><span></span> We are always happy to help you.</h3>
            <p>If you have any questions, feedback, or support-related queries, please feel free to reach out to us. </p>

            <ul>
                <li><i class="fa fa-location-dot"></i> 23 New Design Str,Jodhpur, Rajasthan</li>
                <li><i class="fa fa-phone"></i> +91 78528 33871</li>
                <li><i class="fa fa-envelope"></i>info@agent24india.com, support@agent24india.com  </li>
            </ul>
            </div>

            <!-- LEFT FORM -->
            <div class="contact-form col-lg-6 col-12">

            <form>
                <div class="form-row">
                <input type="text" placeholder="Person Name">
                <input type="email" placeholder="Email">
                </div>

                <div class="form-row">
                <input type="text" placeholder="Phone Number">
                <input type="text" placeholder="Enter Your Subject">
                </div>

                <textarea placeholder="Your Message"></textarea>

                <div class="form-actions">
                <button type="submit">Submit Message</button>
                </div>
            </form>
            </div>

        
        </div>
      </div>
    </section>

<style>

</style>
@endsection

@push('scripts')
<script>
    
</script>
@endpush