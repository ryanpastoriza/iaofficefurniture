<form class="php-email-form">
           
  <input type="hidden" name="page" value="contact">
  <div class="row">
    <div class="col-md-6 form-group">
      <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
    </div>
    <div class="col-md-6 form-group mt-3 mt-md-0">
      <input type="number" class="form-control" name="contact_number" placeholder="Contact Number" required>
    </div>
  </div>

    <div class="form-group mt-3">
    <input type="email" class="form-control" name="email_address" placeholder="Your Email" required>
  </div>

  <div class="form-group mt-3">
    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
  </div>
  <div class="form-group mt-3">
    <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
  </div>

  <div class="mt-2 text-center">
    <button type="submit" class="btn-block">Send Message</button>
  </div>
</form>