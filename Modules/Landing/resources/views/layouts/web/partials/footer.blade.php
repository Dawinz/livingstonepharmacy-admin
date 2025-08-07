{{-- Footer Code Start --}}
<footer class="footer-section py-3 position-relative">
    {{-- footer shape --}}
    <img class="footer-shape1" src="{{ asset('assets/images/icons/footer-shape1.svg') }}" id="image"
    class="">
    <img class="footer-shape2" src="{{ asset('assets/images/icons/shape3.svg') }}" id="image"
    class="">
    {{-- footer shape --}}

    <div class="container">
        <div class="row mt-5 justify-content-between features-section-container">
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('home') }}">
                    <img class="footer-logo"
                        src="{{ asset($page_data['footer_image'] ?? 'assets/images/icons/img-upload.png') }}"
                        alt="footer-logo" class="w-50" />
                </a>
                <p class="mt-4">
                    {{ Str::words($page_data['headings']['footer_short_title'] ?? '', 15, '...') }}
                </p>
                <div class="social-icon">
                    @foreach ($page_data['headings']['footer_socials_links'] ?? [] as $key => $footer_socials_links)
                        <a href="{{ $footer_socials_links ?? '' }}" target="_blank">
                            <img class="footer-social-icon"
                                src="{{ asset($page_data['footer_socials_icons'][$key] ?? 'assets/img/demo-img.png') }}"
                                alt="icon" />
                        </a>
                    @endforeach
                </div>
            </div>


            <div class="col-md-6 col-lg-6">
                <div class="footer-features">
                    <div class="">
                        <h6 class="mb-4 mt-3 mt-sm-0 text-white footer-title ">
                            {{ __('Our App Features') }}</h6>
                        <div class="d-flex align-items-center gap-5 footer-menu ">
                            <ul>

                                <li>
                                    <a href="{{ $page_data['headings']['right_footer_link_one'] ?? '' }}"
                                        target="_blank">{{ Str::words($page_data['headings']['right_footer_one'] ?? '', 3, '...') }}</a>
                                </li>
                                <li>
                                    <a href="{{ $page_data['headings']['right_footer_link_two'] ?? '' }}"
                                        target="_blank">{{ Str::words($page_data['headings']['right_footer_two'] ?? '', 3, '...') }}</a>
                                </li>
                                <li>
                                    <a href="{{ $page_data['headings']['right_footer_link_three'] ?? '' }}"
                                        target="_blank">{{ Str::words($page_data['headings']['right_footer_three'] ?? '', 3, '...') }}</a>
                                </li>
                                <li>
                                    <a href="{{ $page_data['headings']['right_footer_link_four'] ?? '' }}"
                                        target="_blank">{{ Str::words($page_data['headings']['right_footer_four'] ?? '', 3, '...') }}</a>
                                </li>
                                <li>
                                    <a href="{{ $page_data['headings']['right_footer_link_five'] ?? '' }}"
                                        target="_blank">{{ Str::words($page_data['headings']['right_footer_five'] ?? '', 3, '...') }}</a>
                                </li>
                                <li>
                                    <a href="{{ $page_data['headings']['right_footer_link_six'] ?? '' }}"
                                        target="_blank">{{ Str::words($page_data['headings']['right_footer_six'] ?? '', 3, '...') }}</a>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <a href="{{ $page_data['headings']['middle_footer_link_one'] ?? '' }}"
                                        target="_blank">{{ Str::words($page_data['headings']['middle_footer_one'] ?? '', 3, '...') }}</a>
                                </li>
                                <li>
                                    <a href="{{ $page_data['headings']['middle_footer_link_two'] ?? '' }}"
                                        target="_blank">{{ Str::words($page_data['headings']['middle_footer_two'] ?? '', 3, '...') }}</a>
                                </li>
                                <li>
                                    <a href="{{ $page_data['headings']['middle_footer_link_three'] ?? '' }}"
                                        target="_blank">{{ Str::words($page_data['headings']['middle_footer_three'] ?? '', 3, '...') }}</a>
                                </li>
                                <li>
                                    <a href="{{ $page_data['headings']['middle_footer_link_four'] ?? '' }}"
                                        target="_blank">{{ Str::words($page_data['headings']['middle_footer_four'] ?? '', 3, '...') }}</a>
                                </li>
                                <li>
                                    <a href="{{ $page_data['headings']['middle_footer_link_five'] ?? '' }}"
                                        target="_blank">{{ Str::words($page_data['headings']['middle_footer_five'] ?? '', 3, '...') }}</a>

                                </li>
                                <li>
                                    <a href="{{ $page_data['headings']['middle_footer_link_six'] ?? '' }}"
                                        target="_blank">{{ Str::words($page_data['headings']['middle_footer_six'] ?? '', 3, '...') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div class="col-md-6 col-lg-3"></div> --}}
            <div class="col-md-6 col-lg-3 quick-footer footer-menu">
                <h6 class="mb-4 text-white footer-title">{{ __('Quick Links') }}</h6>
                <ul>
                    <li>
                        <a href="{{ url($page_data['headings']['left_footer_link_one'] ?? '') }}"
                            target="_blank">{{ Str::words($page_data['headings']['left_footer_one'] ?? '', 3, '...') }}</a>
                    </li>
                    <li>
                        <a href="{{ url($page_data['headings']['left_footer_link_two'] ?? '') }}"
                            target="_blank">{{ Str::words($page_data['headings']['left_footer_two'] ?? '', 3, '...') }}</a>
                    </li>
                    <li>
                        <a href="{{ url($page_data['headings']['left_footer_link_three'] ?? '') }}"
                            target="_blank">{{ Str::words($page_data['headings']['left_footer_three'] ?? '', 3, '...') }}</a>
                    </li>
                    <li>
                        <a href="{{ url($page_data['headings']['left_footer_link_four'] ?? '') }}"
                            target="_blank">{{ Str::words($page_data['headings']['left_footer_four'] ?? '', 3, '...') }}</a>
                    </li>

                </ul>

            </div>
        </div>
        <hr class="custom-clr-white" />
        <div class="text-center">
            <p class="text-white mb-0">{{ Str::words($general->value['copy_right'] ?? '', 10, '...') }}</p>
        </div>
    </div>

</footer>
