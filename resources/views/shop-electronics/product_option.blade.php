<div class="col-md-6 col-xl-5 offset-xl-1 pt-4">
    <div class="ps-md-4 ps-xl-0">
      <div class="position-relative" id="zoomPane">

        <!-- Model -->
        <div class="pb-3 mb-2 mb-lg-3">
          <label class="form-label fw-semibold pb-1 mb-2">Model</label>
          <div class="d-flex flex-wrap gap-2">
            <input type="radio" class="btn-check" name="model-options" id="gb-64">
            <label for="gb-64" class="btn btn-sm btn-outline-secondary">64 GB</label>
            <input type="radio" class="btn-check" name="model-options" id="gb-128" checked>
            <label for="gb-128" class="btn btn-sm btn-outline-secondary">128 GB</label>
            <input type="radio" class="btn-check" name="model-options" id="gb-256">
            <label for="gb-256" class="btn btn-sm btn-outline-secondary">256 GB</label>
            <input type="radio" class="btn-check" name="model-options" id="gb-512">
            <label for="gb-512" class="btn btn-sm btn-outline-secondary">512 GB</label>
          </div>
        </div>

        <!-- Color -->
        <div class="pb-3 mb-2 mb-lg-3">
          <label class="form-label fw-semibold pb-1 mb-2">Color: <span class="text-body fw-normal" id="colorOption">Gray blue</span></label>
          <div class="d-flex flex-wrap gap-2" data-binded-label="#colorOption">
            <input type="radio" class="btn-check" name="color-options" id="color-1" checked>
            <label for="color-1" class="btn btn-color fs-xl" data-label="Gray blue" style="color: #5a7aa1">
              <span class="visually-hidden">Gray blue</span>
            </label>
            <input type="radio" class="btn-check" name="color-options" id="color-2">
            <label for="color-2" class="btn btn-color fs-xl" data-label="Pink" style="color: #ee7976">
              <span class="visually-hidden">Pink</span>
            </label>
            <input type="radio" class="btn-check" name="color-options" id="color-3">
            <label for="color-3" class="btn btn-color fs-xl" data-label="Light blue" style="color: #9acbf1">
              <span class="visually-hidden">Light blue</span>
            </label>
            <input type="radio" class="btn-check" name="color-options" id="color-4">
            <label for="color-4" class="btn btn-color fs-xl" data-label="Green" style="color: #8cd1ab">
              <span class="visually-hidden">Green</span>
            </label>
          </div>
        </div>

        <!-- Price -->
        <div class="d-flex flex-wrap align-items-center mb-3">
          <div class="h4 mb-0 me-3">$940.00</div>
          <div class="d-flex align-items-center text-success fs-sm ms-auto">
            <i class="ci-check-circle fs-base me-2"></i>
            Available to order
          </div>
        </div>

        <!-- Count + Buttons -->
        <div class="d-flex flex-wrap flex-sm-nowrap flex-md-wrap flex-lg-nowrap gap-3 gap-lg-2 gap-xl-3 mb-4">
          <div class="count-input flex-shrink-0 order-sm-1">
            <button type="button" class="btn btn-icon btn-lg" data-decrement aria-label="Decrement quantity">
              <i class="ci-minus"></i>
            </button>
            <input type="number" class="form-control form-control-lg" value="1" min="1" max="5" readonly>
            <button type="button" class="btn btn-icon btn-lg" data-increment aria-label="Increment quantity">
              <i class="ci-plus"></i>
            </button>
          </div>
          <button type="button" class="btn btn-icon btn-lg btn-secondary animate-pulse order-sm-3 order-md-2 order-lg-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-sm" data-bs-title="Add to Wishlist" aria-label="Add to Wishlist">
            <i class="ci-heart fs-lg animate-target"></i>
          </button>
          <button type="button" class="btn btn-icon btn-lg btn-secondary animate-rotate order-sm-4 order-md-3 order-lg-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-sm" data-bs-title="Compare" aria-label="Compare">
            <i class="ci-refresh-cw fs-lg animate-target"></i>
          </button>
          <button type="button" class="btn btn-lg btn-primary w-100 animate-slide-end order-sm-2 order-md-4 order-lg-2">
            <i class="ci-shopping-cart fs-lg animate-target ms-n1 me-2"></i>
            Add to cart
          </button>
        </div>

        <!-- Features -->
        <div class="d-flex flex-wrap gap-3 gap-xl-4 pb-4 pb-lg-5 mb-2 mb-lg-0 mb-xl-2">
          <div class="d-flex align-items-center fs-sm">
            <svg class="text-warning me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"><path d="M1.333 9.667H7.5V16h-5c-.64 0-1.167-.527-1.167-1.167V9.667zm13.334 0v5.167c0 .64-.527 1.167-1.167 1.167h-5V9.667h6.167zM0 5.833V7.5c0 .64.527 1.167 1.167 1.167h.167H7.5v-1-3H1.167C.527 4.667 0 5.193 0 5.833zm14.833-1.166H8.5v3 1h6.167.167C15.473 8.667 16 8.14 16 7.5V5.833c0-.64-.527-1.167-1.167-1.167z"/><path d="M8 5.363a.5.5 0 0 1-.495-.573C7.752 3.123 9.054-.03 12.219-.03c1.807.001 2.447.977 2.447 1.813 0 1.486-2.069 3.58-6.667 3.58zM12.219.971c-2.388 0-3.295 2.27-3.595 3.377 1.884-.088 3.072-.565 3.756-.971.949-.563 1.287-1.193 1.287-1.595 0-.599-.747-.811-1.447-.811z"/><path d="M8.001 5.363c-4.598 0-6.667-2.094-6.667-3.58 0-.836.641-1.812 2.448-1.812 3.165 0 4.467 3.153 4.713 4.819a.5.5 0 0 1-.495.573zM3.782.971c-.7 0-1.448.213-1.448.812 0 .851 1.489 2.403 5.042 2.566C7.076 3.241 6.169.971 3.782.971z"/></svg>
            <div class="text-body-emphasis text-nowrap"><span class="fw-semibold">+32</span> bonuses</div>
          </div>
          <div class="d-flex align-items-center fs-sm">
            <svg class="text-primary me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"><path d="M15.264 8.001l.702-1.831a.5.5 0 0 0-.152-.568l-1.522-1.234-.308-1.937a.5.5 0 0 0-.416-.415l-1.937-.308L10.399.185a.5.5 0 0 0-.567-.152L8 .736 6.169.034a.5.5 0 0 0-.567.152L4.368 1.709l-1.937.308a.5.5 0 0 0-.415.415l-.308 1.937L.185 5.603a.5.5 0 0 0-.152.567l.702 1.831-.702 1.831a.5.5 0 0 0 .152.567l1.523 1.233.308 1.937a.5.5 0 0 0 .415.416l1.937.308 1.234 1.522c.137.17.366.23.568.152L8 15.265l1.831.702a.5.5 0 0 0 .568-.153l1.233-1.522 1.937-.308a.5.5 0 0 0 .416-.416l.308-1.937 1.522-1.233a.5.5 0 0 0 .152-.567l-.702-1.831z" fill="currentColor"/><path d="M6.5 7.001a1.5 1.5 0 1 1 0-3 1.5 1.5 0 1 1 0 3zm0-2a.5.5 0 1 0 0 1 .5.5 0 1 0 0-1zM9.5 12a1.5 1.5 0 1 1 0-3 1.5 1.5 0 1 1 0 3zm0-2a.5.5 0 1 0 0 1 .5.5 0 1 0 0-1zm-4 2c-.101 0-.202-.03-.29-.093a.5.5 0 0 1-.116-.698l5-7a.5.5 0 1 1 .814.581l-5 7A.5.5 0 0 1 5.5 12z" fill="white"/></svg>
            <div class="text-body-emphasis text-nowrap">Interest-free loan</div>
          </div>
          <div class="d-flex align-items-center fs-sm">
            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"><path class="text-success" d="M7.42169 1.15662C3.3228 1.15662 0 4.47941 0 8.5783C0 12.6772 3.3228 16 7.42169 16C11.5206 16 14.8434 12.6772 14.8434 8.5783H7.42169V1.15662Z" fill="currentColor"/><path class="text-info" d="M8.57812 0V7.42169H15.9998C15.9998 3.3228 12.677 0 8.57812 0Z" fill="currentColor"/><defs><rect width="16" height="16" fill="white"/></defs></svg>
            <div class="text-body-emphasis text-nowrap">Pay by installments</div>
          </div>
        </div>
      </div>

      <!-- Shipping options -->
      <div class="d-flex align-items-center pb-2">
        <h3 class="h6 mb-0">Shipping options</h3>
        <a class="btn btn-sm btn-secondary ms-auto" href="#!">
          <i class="ci-map-pin fs-sm ms-n1 me-1"></i>
          Find local store
        </a>
      </div>
      <table class="table table-borderless fs-sm mb-2">
        <tbody>
          <tr>
            <td class="py-2 ps-0">Pickup from the store</td>
            <td class="py-2">Today</td>
            <td class="text-body-emphasis fw-semibold text-end py-2 pe-0">Free</td>
          </tr>
          <tr>
            <td class="py-2 ps-0">Pickup from postal offices</td>
            <td class="py-2">Tomorrow</td>
            <td class="text-body-emphasis fw-semibold text-end py-2 pe-0">$25.00</td>
          </tr>
          <tr>
            <td class="py-2 ps-0">Delivery by courier</td>
            <td class="py-2">2-3 days</td>
            <td class="text-body-emphasis fw-semibold text-end py-2 pe-0">$35.00</td>
          </tr>
        </tbody>
      </table>

      <!-- Warranty + Payment info accordion -->
      <div class="accordion" id="infoAccordion">
        <div class="accordion-item border-top">
          <h3 class="accordion-header" id="headingWarranty">
            <button type="button" class="accordion-button animate-underline collapsed" data-bs-toggle="collapse" data-bs-target="#warranty" aria-expanded="false" aria-controls="warranty">
              <span class="animate-target me-2">Warranty information</span>
            </button>
          </h3>
          <div class="accordion-collapse collapse" id="warranty" aria-labelledby="headingWarranty" data-bs-parent="#infoAccordion">
            <div class="accordion-body">
              <div class="alert d-flex alert-info mb-3" role="alert">
                <i class="ci-check-shield fs-xl mt-1 me-2"></i>
                <div class="fs-sm"><span class="fw-semibold">Warranty:</span> 12 months of official manufacturer's warranty. Exchange/return of the product within 14 days.</div>
              </div>
              <p class="mb-0">Explore the details of our <a class="fw-medium" href="#!">product warranties here</a>, including duration, coverage, and any additional protection plans available. We prioritize your satisfaction, and our warranty information is designed to keep you informed and confident in your purchase.</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h3 class="accordion-header" id="headingPayment">
            <button type="button" class="accordion-button animate-underline collapsed" data-bs-toggle="collapse" data-bs-target="#payment" aria-expanded="false" aria-controls="payment">
              <span class="animate-target me-2">Payment and credit</span>
            </button>
          </h3>
          <div class="accordion-collapse collapse" id="payment" aria-labelledby="headingPayment" data-bs-parent="#infoAccordion">
            <div class="accordion-body">Experience hassle-free transactions with our <a class="fw-medium" href="#!">flexible payment options</a> and credit facilities. Learn more about the various payment methods accepted, installment plans, and any exclusive credit offers available to make your shopping experience seamless.</div>
          </div>
        </div>
      </div>
    </div>
</div>
