@extends('admin.layouts.horizontal', ['title' => 'Form Validation', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    @include('admin.layouts.shared/page-title', ['page_title' => 'Validation', 'sub_title' => 'Forms'])

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Custom styles</h4>
                    <p class="text-muted mb-0">Custom feedback styles apply custom colors, borders,
                        focus styles, and background
                        icons to better communicate feedback. Background icons for
                        <code>&lt;select&gt;</code>s are only available with
                        <code>.form-select</code>, and not <code>.form-control</code>.
                    </p>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">First name</label>
                            <input type="text" class="form-control" id="validationCustom01" placeholder="First name"
                                value="Mark" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom02">Last name</label>
                            <input type="text" class="form-control" id="validationCustom02" placeholder="Last name"
                                value="Otto" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustomUsername">Username</label>
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="text" class="form-control" id="validationCustomUsername"
                                    placeholder="Username" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Please choose a username.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom03">City</label>
                            <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom04">State</label>
                            <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom05">Zip</label>
                            <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="invalidCheck" required>
                                <label class="form-check-label form-label" for="invalidCheck">Agree to
                                    terms
                                    and conditions</label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->


        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Tooltips</h4>
                    <p class="text-muted mb-0">If your form layout allows it, you can swap the
                        <code>.{valid|invalid}-feedback</code> classes for
                        <code>.{valid|invalid}-tooltip</code> classes to display validation feedback in
                        a styled tooltip. Be sure to have a parent with <code>position: relative</code>
                        on it for tooltip positioning. In the example below, our column classes have
                        this already, but your project may require an alternative setup.
                    </p>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="position-relative mb-3">
                            <label class="form-label" for="validationTooltip01">First name</label>
                            <input type="text" class="form-control" id="validationTooltip01" placeholder="First name"
                                value="Mark" required>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                            <div class="invalid-tooltip">
                                Please enter first name.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label" for="validationTooltip02">Last name</label>
                            <input type="text" class="form-control" id="validationTooltip02" placeholder="Last name"
                                value="Otto" required>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                            <div class="invalid-tooltip">
                                Please enter last name.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label" for="validationTooltipUsername">Username</label>
                            <div class="input-group">
                                <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                <input type="text" class="form-control" id="validationTooltipUsername"
                                    placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                                <div class="invalid-tooltip">
                                    Please choose a unique and valid username.
                                </div>
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label" for="validationTooltip03">City</label>
                            <input type="text" class="form-control" id="validationTooltip03" placeholder="City"
                                required>
                            <div class="invalid-tooltip">
                                Please provide a valid city.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label" for="validationTooltip04">State</label>
                            <input type="text" class="form-control" id="validationTooltip04" placeholder="State"
                                required>
                            <div class="invalid-tooltip">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label" for="validationTooltip05">Zip</label>
                            <input type="text" class="form-control" id="validationTooltip05" placeholder="Zip"
                                required>
                            <div class="invalid-tooltip">
                                Please provide a valid zip.
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row -->
@endsection
