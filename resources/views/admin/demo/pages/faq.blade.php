@extends('admin.layouts.horizontal', ['title' => 'FAQ', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('admin.layouts.shared/page-title', ['sub_title' => 'Base UI', 'page_title' => 'FAQ'])

    <div class="row">
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="mb-4 text-center">
                        <h3 class="">Frequently Asked Questions</h3>
                        <p class="text-muted mt-3">
                            Do you have a question about your subscription, a recent order, products, shipping or you want
                            to suggest a new magazine? Here you can find some helpful answers to frequently asked questions
                            (FAQ).
                        </p>

                        <button type="button" class="btn btn-success mt-2"><i class="ri-mail-line me-1"></i> Email us your
                            question</button>
                        <button type="button" class="btn btn-info mt-2 ms-1"><i class="ri-twitter-line me-1"></i> Send us a
                            tweet</button>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
            <div class="card">
                <div class="card-body">

                    <div class="row justify-content-center mt-4">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div>
                                        <div class="faq-question-q-box">Q.</div>
                                        <h4 class="faq-question" data-wow-delay=".1s">What does LOREM mean?</h4>
                                        <p class="faq-answer mb-4">Lorem ipsum dolor sit amet, consectetur adipisici elit…’
                                            (complete text) is dummy text that is not meant to mean anything. It is used as
                                            a placeholder in magazine layouts, for example, in order to give an impression
                                            of the finished document.</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div>
                                        <div class="faq-question-q-box">Q.</div>
                                        <h4 class="faq-question">Where can I subscribe to your newsletter?</h4>
                                        <p class="faq-answer mb-4">We often send out our newsletter with news and great
                                            offers. We will never disclose your data to third parties and you can
                                            unsubscribe from the newsletter at any time. Subscribe here to our newsletter.
                                        </p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div>
                                        <div class="faq-question-q-box">Q.</div>
                                        <h4 class="faq-question">Where can I edit my billing and shipping address?</h4>
                                        <p class="faq-answer mb-4">If you created a new account after or while ordering you
                                            can edit both addresses (for billing and shipping) in your customer account.</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div>
                                        <div class="faq-question-q-box">Q.</div>
                                        <h4 class="faq-question" data-wow-delay=".1s">Can I order a free sample copy of a
                                            magazine?</h4>
                                        <p class="faq-answer mb-4">Unfortunately, we’re unable to offer free samples. As a
                                            retailer, we buy all magazines from their publishers at the regular trade price.
                                            However, you could contact the publisher directly.</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div>
                                        <div class="faq-question-q-box">Q.</div>
                                        <h4 class="faq-question">Are unsold magazines sent back to the publisher?</h4>
                                        <p class="faq-answer mb-4">We usually sell all copies of the magazines offered in
                                            our shop. Some publishers and distributors offer the retailer the option of
                                            returning any unsold magazines. However, because our range includes magazines
                                            from countries such as Australia, the USA and the United Kingdom.</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div>
                                        <div class="faq-question-q-box">Q.</div>
                                        <h4 class="faq-question">Are unsold magazines sent back to the publisher?</h4>
                                        <p class="faq-answer mb-4">We usually sell all copies of the magazines offered in
                                            our shop. Some publishers and distributors offer the retailer the option of
                                            returning any unsold magazines. However, because our range includes magazines
                                            from countries such as Australia, the USA and the United Kingdom.</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div>
                                        <div class="faq-question-q-box">Q.</div>
                                        <h4 class="faq-question">When can be used?</h4>
                                        <p class="faq-answer mb-4">We receive up to 20 enquiries per week from publishers
                                            all around the world. Because we can’t always respond to each one right away,
                                            all enquiries are checked and answered in chronological order.</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div>
                                        <div class="faq-question-q-box">Q.</div>
                                        <h4 class="faq-question">License &amp; Copyright</h4>
                                        <p class="faq-answer mb-4">Wow, we’re happy to see more of your great publication.
                                            Please find our address on the contact page.</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-md-4">
                                    <div>
                                        <div class="faq-question-q-box">Q.</div>
                                        <h4 class="faq-question">Do I have to pay customs or import fees?</h4>
                                        <p class="faq-answer mb-4">In some countries import fees/taxes may apply to your
                                            order. They will be charged from your the carrier or local post service. Please
                                            note: We are not responsible for any customs and duties charged to a customer.
                                        </p>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end-row -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
