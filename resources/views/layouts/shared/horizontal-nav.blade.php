<!-- ========== Horizontal Menu Start ========== -->
<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('any', 'index')}}" id="topnav-dashboards" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-dashboard-3-line"></i>Dashboards
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-pages-line"></i>Pages <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Authenitication <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                    <a href="{{ route('second', ['auth', 'login']) }}" class="dropdown-item">Login</a>
                                    <a href="{{ route('second', ['auth', 'register']) }}" class="dropdown-item">Register</a>
                                    <a href="{{ route('second', ['auth', 'logout']) }}" class="dropdown-item">Logout</a>
                                    <a href="{{ route('second', ['auth', 'forgotpw']) }}" class="dropdown-item">Forgot Password</a>
                                    <a href="{{ route('second', ['auth', 'lock-screen']) }}" class="dropdown-item">Lock Screen</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-error"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Error <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-error">
                                    <a href="{{ route('second', ['error', '404']) }}" class="dropdown-item">Error 404</a>
                                    <a href="{{ route('second', ['error', '404-alt']) }}" class="dropdown-item">Error 404-alt</a>
                                    <a href="{{ route('second', ['error', '500']) }}" class="dropdown-item">Error 500</a>
                                </div>
                            </div>
                            <a href="{{ route('second', ['pages', 'starter']) }}" class="dropdown-item">Starter Page</a>
                            <a href="{{ route('second', ['pages', 'contact-list']) }}" class="dropdown-item">Contact List</a>
                            <a href="{{ route('second', ['pages', 'profile']) }}" class="dropdown-item">Profile</a>
                            <a href="{{ route('second', ['pages', 'timeline']) }}" class="dropdown-item">Timeline</a>
                            <a href="{{ route('second', ['pages', 'invoice']) }}" class="dropdown-item">Invoice</a>
                            <a href="{{ route('second', ['pages', 'faq']) }}" class="dropdown-item">FAQ</a>
                            <a href="{{ route('second', ['pages', 'pricing']) }}" class="dropdown-item">Pricing</a>
                            <a href="{{ route('second', ['pages', 'maintenance']) }}" class="dropdown-item">Maintenance</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-briefcase-line"></i>Components <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ui-kit"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Base UI 1 <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-ui-kit">
                                    <a href="{{ route('second', ['ui', 'accordions']) }}" class="dropdown-item">Accordions</a>
                                    <a href="{{ route('second', ['ui', 'alerts']) }}" class="dropdown-item">Alerts</a>
                                    <a href="{{ route('second', ['ui', 'avatars']) }}" class="dropdown-item">Avatars</a>
                                    <a href="{{ route('second', ['ui', 'badges']) }}" class="dropdown-item">Badges</a>
                                    <a href="{{ route('second', ['ui', 'breadcrumb']) }}" class="dropdown-item">Breadcrumb</a>
                                    <a href="{{ route('second', ['ui', 'buttons']) }}" class="dropdown-item">Buttons</a>
                                    <a href="{{ route('second', ['ui', 'cards']) }}" class="dropdown-item">Cards</a>
                                    <a href="{{ route('second', ['ui', 'carousel']) }}" class="dropdown-item">Carousel</a>
                                    <a href="{{ route('second', ['ui', 'dropdowns']) }}" class="dropdown-item">Dropdowns</a>
                                    <a href="{{ route('second', ['ui', 'embed-video']) }}" class="dropdown-item">Embed Video</a>
                                    <a href="{{ route('second', ['ui', 'grid']) }}" class="dropdown-item">Grid</a>
                                    <a href="{{ route('second', ['ui', 'list-group']) }}" class="dropdown-item">List Group</a>
                                    <a href="{{ route('second', ['ui', 'links']) }}" class="dropdown-item">Links</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ui-kit2"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Base UI 2 <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-ui-kit2">
                                    <a href="{{ route('second', ['ui', 'modals']) }}" class="dropdown-item">Modals</a>
                                    <a href="{{ route('second', ['ui', 'notifications']) }}" class="dropdown-item">Notifications</a>
                                    <a href="{{ route('second', ['ui', 'offcanvas']) }}" class="dropdown-item">Offcanvas</a>
                                    <a href="{{ route('second', ['ui', 'placeholders']) }}" class="dropdown-item">Placeholders</a>
                                    <a href="{{ route('second', ['ui', 'pagination']) }}" class="dropdown-item">Pagination</a>
                                    <a href="{{ route('second', ['ui', 'popovers']) }}" class="dropdown-item">Popovers</a>
                                    <a href="{{ route('second', ['ui', 'progress']) }}" class="dropdown-item">Progress</a>
                                    <a href="{{ route('second', ['ui', 'spinners']) }}" class="dropdown-item">Spinners</a>
                                    <a href="{{ route('second', ['ui', 'tabs']) }}" class="dropdown-item">Tabs</a>
                                    <a href="{{ route('second', ['ui', 'tooltips']) }}" class="dropdown-item">Tooltips</a>
                                    <a href="{{ route('second', ['ui', 'typography']) }}" class="dropdown-item">Typography</a>
                                    <a href="{{ route('second', ['ui', 'utilities']) }}" class="dropdown-item">Utilities</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-extended-ui"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Extended UI <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-extended-ui">
                                    <a href="{{ route('second', ['extended', 'portlets']) }}" class="dropdown-item">Portlets</a>
                                    <a href="{{ route('second', ['extended', 'scrollbar']) }}" class="dropdown-item">Scrollbar</a>
                                    <a href="{{ route('second', ['extended', 'range-slider']) }}" class="dropdown-item">Range Slider</a>
                                    <a href="{{ route('second', ['extended', 'scrollspy']) }}" class="dropdown-item">Scrollspy</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-forms"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Forms <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-forms">
                                    <a href="{{ route('second', ['form', 'elements']) }}" class="dropdown-item">Basic Elements</a>
                                    <a href="{{ route('second', ['form', 'advanced']) }}" class="dropdown-item">Form Advanced</a>
                                    <a href="{{ route('second', ['form', 'validation']) }}" class="dropdown-item">Form Validation</a>
                                    <a href="{{ route('second', ['form', 'wizard']) }}" class="dropdown-item">Form Wizard</a>
                                    <a href="{{ route('second', ['form', 'fileuploads']) }}" class="dropdown-item">File Uploads</a>
                                    <a href="{{ route('second', ['form', 'editors']) }}" class="dropdown-item">Form Editors</a>
                                    <a href="{{ route('second', ['form', 'image-crop']) }}" class="dropdown-item">Image Crop</a>
                                    <a href="{{ route('second', ['form', 'x-editable']) }}" class="dropdown-item">X Editable</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Charts <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                    <a href="{{ route('second', ['charts', 'apex']) }}" class="dropdown-item">Apex Charts</a>
                                    <a href="{{ route('second', ['charts', 'chartjs']) }}" class="dropdown-item">Chartjs</a>
                                    <a href="{{ route('second', ['charts', 'sparklines']) }}" class="dropdown-item">Sparkline Charts</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-tables"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tables <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-tables">
                                    <a href="{{ route('second', ['tables', 'basic']) }}" class="dropdown-item">Basic Tables</a>
                                    <a href="{{ route('second', ['tables', 'datatable']) }}" class="dropdown-item">Data Tables</a>
                                    <a href="{{ route('second', ['tables', 'editable']) }}" class="dropdown-item">Editable Tables</a>
                                    <a href="{{ route('second', ['tables', 'responsive']) }}" class="dropdown-item">Responsive Table</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Icons <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                    <a href="{{ route('second', ['icons', 'remixicons']) }}" class="dropdown-item">Remix Icons</a>
                                    <a href="{{ route('second', ['icons', 'bootstrap']) }}" class="dropdown-item">Bootstrap Icons</a>
                                    <a href="{{ route('second', ['icons', 'mdi']) }}" class="dropdown-item">Material Design Icons</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-maps"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Maps <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-maps">
                                    <a href="{{ route('second', ['maps', 'google']) }}" class="dropdown-item">Google Maps</a>
                                    <a href="{{ route('second', ['maps', 'vector']) }}" class="dropdown-item">Vector Maps</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layouts" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-layout-line"></i>Layouts <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-layouts">
                            <a href="{{ route('second', ['layouts-eg', 'horizontal']) }}" class="dropdown-item" target="_blank">Horizontal</a>
                            <a href="{{ route('second', ['layouts-eg', 'light-sidebar']) }}" class="dropdown-item" target="_blank">Light Sidebar</a>
                            <a href="{{ route('second', ['layouts-eg', 'sm-sidebar']) }}" class="dropdown-item" target="_blank">Small Sidebar</a>
                            <a href="{{ route('second', ['layouts-eg', 'collapsed-sidebar']) }}" class="dropdown-item" target="_blank">Collapsed Sidebar</a>
                            <a href="{{ route('second', ['layouts-eg', 'unsticky-layout']) }}" class="dropdown-item" target="_blank">Unsticky Layout</a>
                            <a href="{{ route('second', ['layouts-eg', 'boxed']) }}" class="dropdown-item" target="_blank">Boxed Layout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ========== Horizontal Menu End ========== -->