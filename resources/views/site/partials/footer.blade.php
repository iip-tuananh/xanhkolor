<footer class="footer">
    <div class="mid-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12 col-left">
                    <div class="logo-footer">
                        <a href="{{route('front.home-page')}}" class="logo" title="Logo">
                            <img width="188" height="46"
                                src="{{$config->image->path ?? ''}}"
                                alt="{{$config->web_title ?? ''}}">
                        </a>
                    </div>
                    <div class="des-footer">
                        {{$config->web_des}}
                    </div>
                    <div class="social-footer">
                        <a href="{{$config->facebook ?? ''}}" class="social-button" title="Facebook" target="_blank"
                            rel="nofollow">
                            <svg class="icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-facebook">
                                </use>
                            </svg>
                        </a>
                        <a href="{{$config->youtube ?? ''}}" class="social-button" title="Youtube" target="_blank"
                            rel="nofollow">
                            <svg class="icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-youtube">
                                </use>
                            </svg>
                        </a>
                        <a href="{{$config->shopee ?? ''}}" class="social-button" title="Shopee" target="_blank"
                            rel="nofollow">
                            <svg class="icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-twitter">
                                </use>
                            </svg>
                        </a>
                        <a href="{{$config->instagram ?? ''}}" class="social-button" title="Instagram" target="_blank"
                            rel="nofollow">
                            <svg class="icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                    xlink:href="#icon-instagram"></use>
                            </svg>
                        </a>
                        <a href="{{$config->google ?? ''}}" class="social-button" title="Google" target="_blank"
                            rel="nofollow">
                            <svg class="icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-google">
                                </use>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-12 col-right">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12 link_list col-footer">
                            <h4 class="title-menu">
                                Về chúng tôi
                                <span class="Collapsible__Plus"></span>
                            </h4>
                            <div class="list-menu hidden-mobile">
                                <a href="{{route('front.home-page')}}" title="Trang chủ">Trang chủ</a>
                                <a href="{{route('front.about-us')}}" title="Giới thiệu">Giới thiệu</a>
                                @foreach ($post_categories as $category)
                                <a href="{{route('front.list-blog', $category->slug)}}" title="{{$category->name}}">{{$category->name}}</a>
                                @endforeach
                                <a href="{{route('front.contact-us')}}" title="Liên hệ">Liên hệ</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 link_list col-footer">
                            <h4 class="title-menu">
                                Hỗ trợ khách hàng
                                <span class="Collapsible__Plus"></span>
                            </h4>
                            <div class="list-menu hidden-mobile">
                                @foreach ($policies as $policy)
                                <a href="{{route('front.policy-detail', $policy->slug)}}" title="{{$policy->title}}">{{$policy->title}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 col-footer">
                            <h4 class="title-menu">
                                Tư vấn khách hàng
                                <span class="Collapsible__Plus"></span>
                            </h4>
                            <div class="hidden-mobile">
                                <div class="contact-footer">
                                    <div class="item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                            height="23" viewBox="0 0 18 23" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9 22.3781L9.65773 21.8038C15.1887 16.9743 18 12.7573 18 9.05054C18 3.8012 13.9029 0.0505371 9 0.0505371C4.09705 0.0505371 0 3.8012 0 9.05054C0 12.7573 2.81131 16.9743 8.34227 21.8038L9 22.3781ZM9 19.7139C4.30661 15.4841 2 11.8998 2 9.05054C2 4.94714 5.16411 2.05054 9 2.05054C12.8359 2.05054 16 4.94714 16 9.05054C16 11.8998 13.6934 15.4841 9 19.7139ZM9 4.05054C11.7614 4.05054 14 6.28911 14 9.05054C14 11.812 11.7614 14.0505 9 14.0505C6.23858 14.0505 4 11.812 4 9.05054C4 6.28911 6.23858 4.05054 9 4.05054ZM6 9.05054C6 7.39368 7.34315 6.05054 9 6.05054C10.6569 6.05054 12 7.39368 12 9.05054C12 10.7074 10.6569 12.0505 9 12.0505C7.34315 12.0505 6 10.7074 6 9.05054Z"
                                                fill="#E36756" />
                                        </svg>
                                        {{$config->address_company ?? ''}}
                                    </div>
                                    <div class="item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22"
                                            height="19" viewBox="0 0 22 19" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2 0.0505371H20C21.1046 0.0505371 22 0.945968 22 2.05054V16.0505C22 17.1551 21.1046 18.0505 20 18.0505H2C0.89543 18.0505 0 17.1551 0 16.0505V2.05054C0 0.945968 0.89543 0.0505371 2 0.0505371ZM2 6.66865V16.0505H20V6.66907L11 11.1691L2 6.66865ZM2 4.43254L11 8.93299L20 4.433V2.05054H2V4.43254Z"
                                                fill="#E36756" />
                                        </svg>
                                        <a href="mailto:{{$config->email ?? ''}}">{{$config->email ?? ''}}</a>
                                    </div>
                                    <div class="item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21"
                                            height="21" viewBox="0 0 21 21" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9.85651 6.38844C10.3746 5.69023 10.5604 4.95438 9.97444 4.30485C8.65949 2.46487 7.77515 1.32703 7.22044 0.779074C6.16589 -0.262659 4.43112 -0.121748 3.51779 0.778184C3.02723 1.26155 2.86116 1.42754 2.35747 1.93915C-0.448184 4.7463 1.26285 10.6805 5.81139 15.2336C10.3589 19.7855 16.2926 21.4975 19.1041 18.6844C19.5689 18.2363 19.9624 17.8426 20.2728 17.5145C21.1678 16.5685 21.3037 14.9102 20.2669 13.833C19.7354 13.2806 18.6503 12.439 16.7329 11.0675C16.1457 10.5424 15.4494 10.6562 14.811 11.075C14.504 11.2764 14.2805 11.4802 13.8585 11.9026L13.0923 12.6693C12.9914 12.7702 11.621 12.0839 10.2907 10.7524C8.95972 9.42007 8.2739 8.0496 8.37435 7.94915L9.14112 7.18196C9.27499 7.04795 9.339 6.98307 9.42108 6.89681C9.59209 6.71708 9.73368 6.55397 9.85651 6.38844ZM14.5057 14.0835L15.2721 13.3167C15.5044 13.0842 15.6549 12.9413 15.7773 12.8427C17.457 14.0489 18.4297 14.8074 18.8271 15.2202C19.0656 15.4681 19.0286 15.9204 18.8212 16.1396C18.5342 16.4429 18.1613 16.816 17.7037 17.2573C15.8857 19.0761 11.0959 17.6942 7.22513 13.8196C3.35315 9.94385 1.97189 5.15332 3.7762 3.34802C4.27786 2.83851 4.43681 2.67965 4.92036 2.20319C5.10166 2.02454 5.59552 1.98442 5.81608 2.2023C6.24315 2.62417 7.03534 3.63852 8.20071 5.26186C8.14038 5.33676 8.06503 5.4214 7.97334 5.51777C7.90603 5.58851 7.84996 5.64535 7.72738 5.76805L6.96136 6.53449C5.65821 7.83753 6.76802 10.0552 8.87698 12.1663C10.9845 14.2759 13.203 15.3869 14.5057 14.0835ZM12.6549 0.11998C16.9782 0.644018 20.4063 4.07207 20.9303 8.39539L18.9549 8.72463C18.5735 5.24226 15.8081 2.47684 12.3257 2.09542L12.6549 0.11998ZM11.9963 4.07256C14.6378 4.30882 16.7416 6.41262 16.9779 9.05415L14.9961 9.38444C14.912 7.58355 13.4669 6.13843 11.666 6.05433L11.9963 4.07256Z"
                                                fill="#E36756" />
                                        </svg>
                                        <a class="fone" href="tel:{{str_replace(' ', '', $config->hotline ?? '')}}">{{$config->hotline ?? ''}}</a>
                                    </div>
                                    <div class="item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="21" viewBox="0 0 20 21" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2 0.0505371H18C19.1046 0.0505371 20 0.945968 20 2.05054V18.0505C20 19.1551 19.1046 20.0505 18 20.0505H2C0.89543 20.0505 0 19.1551 0 18.0505V2.05054C0 0.945968 0.89543 0.0505371 2 0.0505371ZM2 2.05054V18.0505H18V2.05054H2ZM9.13306 10.0549H11V16.0505H13V10.0549H14.9824V8.05493H13V7.05054C13 6.49825 13.4477 6.05054 14 6.05054H15V4.05054H14C12.3431 4.05054 11 5.39368 11 7.05054V8.05493H9.13306V10.0549Z"
                                                fill="#E36756" />
                                        </svg>
                                        <a class="fone" href="{{$config->facebook ?? ''}}">Facebook</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="copyright" class="copyright">
        <div class="container">
            <div class="wsp">
                @ Bản quyền thuộc về {{$config->web_title ?? ''}}
            </div>
        </div>
    </div>
</footer>
<a href="#" class="backtop" title="Lên đầu trang">
    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="angle-up" role="img"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
        class="svg-inline--fa fa-angle-up fa-w-10">
        <path fill="currentColor"
            d="M168.5 164.2l148 146.8c4.7 4.7 4.7 12.3 0 17l-19.8 19.8c-4.7 4.7-12.3 4.7-17 0L160 229.3 40.3 347.8c-4.7 4.7-12.3 4.7-17 0L3.5 328c-4.7-4.7-4.7-12.3 0-17l148-146.8c4.7-4.7 12.3-4.7 17 0z"
            class=""></path>
    </svg>
</a>