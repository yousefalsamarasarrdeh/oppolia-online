<div class="modal fade" id="phoneModal" tabindex="-1" aria-labelledby="phoneModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="phoneForm">
                <div class="modal-body">
                    <div class="mb-3 mytext_center">
                        <label for="phone" class="form-label myfont_4">@lang('home.Register Now')</label>
                        <div class="input-container">
                            <!-- صورة علم السعودية -->
                            <img src="https://upload.wikimedia.org/wikipedia/commons/0/0d/Flag_of_Saudi_Arabia.svg" alt="علم السعودية">
                            <input type="text" class="form-control myborder_radiu_5" id="phone" name="phone" value="+966" required>
                        </div>
                        <button type="submit" class="btn mycolor_btn myfill_width mt-3 myborder_radiu_5">@lang('home.Send')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- مودال إدخال OTP -->
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="otpForm" method="POST" action="{{ route('otp.verify') }}">
                @csrf
                <div class="modal-body mx-4">
                    <div class="mb-3 mytext_center">
                        <label for="otp" class="form-label myfont_4">@lang('home.Mobile number verification')</label>
                        <div class="d-flex justify-content-center gap-2">
                            <!-- 6 خانات OTP -->
                            <input type="text" class="form-control otp-input myborder_radiu_5" maxlength="1" required>
                            <input type="text" class="form-control otp-input myborder_radiu_5" maxlength="1" required>
                            <input type="text" class="form-control otp-input myborder_radiu_5" maxlength="1" required>
                            <input type="text" class="form-control otp-input myborder_radiu_5" maxlength="1" required>
                            <input type="text" class="form-control otp-input myborder_radiu_5" maxlength="1" required>
                            <input type="text" class="form-control otp-input myborder_radiu_5" maxlength="1" required>
                        </div>
                        <button type="submit" class="btn mycolor_btn myfill_width mt-3 myborder_radiu_5">@lang('home.Send')</button>
                    </div>
                    <input type="hidden" id="otpPhone" name="phone">
                    <input type="hidden" id="otp" name="otp">
                </div>
                <div class="modal-footer"></div>
            </form>

        </div>
    </div>
</div>
