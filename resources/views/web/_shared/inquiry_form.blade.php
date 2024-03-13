  <div class="container contact mb-3">
    
        <div class="row">

          <div class="col-lg-5 mb-5 d-flex justify-content-center">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Unit 3 Alfina Bldg, 892 Quirino Highway, Quezon City, 1117 Metro Manila</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>sample@example.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>8461-6279/ 8232-1452/ 8232-1454</p>
              </div>

            </div>

          </div>

          <div class="col-lg-7">  
            
            <div class="">
              <form class="php-email-form" action="{{ route('inquiry.store') }}" method="post" id="inquiry-form">
                @csrf
                <input type="hidden" name="page" value="contact">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="number" class="form-control" name="contact_number" placeholder="Contact Number" required>
                  </div>
                </div>

                  <div class="form-group mt-3">
                  <input type="email" class="form-control" name="email_address" placeholder="Email Address" required>
                </div>

                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                </div>

                <div class="mt-2">
                  <button type="submit" class="btn-block rounded-0"> <i class="bi bi-send"></i> Send Now </button>
                </div>
              </form>
            </div>

          </div>

        </div>

      </div>