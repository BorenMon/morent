<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('any', 'index') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="/images/logo.png" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('any', 'index') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="/images/logo-dark.png" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Main</li>

            <li class="side-nav-item">
                <a href="{{ route('any', 'index') }}" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span class="badge bg-success float-end">9+</span>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages"
                    class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Pages </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('second', ['pages', 'starter']) }}">Starter Page</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['pages', 'contact-list']) }}">Contact List</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['pages', 'profile']) }}">Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['pages', 'timeline']) }}">Timeline</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['pages', 'invoice']) }}">Invoice</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['pages', 'faq']) }}">FAQ</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['pages', 'pricing']) }}">Pricing</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['pages', 'maintenance']) }}">Maintenance</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['error', '404']) }}">Error 404</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['error', '404-alt']) }}">Error 404-alt</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['error', '500']) }}">Error 500</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPagesAuth" aria-expanded="false"
                    aria-controls="sidebarPagesAuth" class="side-nav-link">
                    <i class="ri-group-2-line"></i>
                    <span> Authentication </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPagesAuth">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('second', ['auth', 'login']) }}">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['auth', 'register']) }}">Register</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['auth', 'logout']) }}">Logout</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['auth', 'forgotpw']) }}">Forgot Password</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['auth', 'lock-screen']) }}">Lock Screen</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLayouts" aria-expanded="false" aria-controls="sidebarLayouts"
                    class="side-nav-link">
                    <i class="ri-layout-line"></i>
                    <span class="badge bg-warning float-end">New</span>
                    <span> Layouts </span>
                </a>
                <div class="collapse" id="sidebarLayouts">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('second', ['layouts-eg', 'horizontal']) }}" target="_blank">Horizontal</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['layouts-eg', 'light-sidebar']) }}" target="_blank">Light Sidebar</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['layouts-eg', 'sm-sidebar']) }}" target="_blank">Small Sidebar</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['layouts-eg', 'collapsed-sidebar']) }}" target="_blank">Collapsed Sidebar</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['layouts-eg', 'unsticky-layout']) }}" target="_blank">Unsticky Layout</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['layouts-eg', 'boxed']) }}" target="_blank">Boxed Layout</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-title">Components</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarBaseUI" aria-expanded="false" aria-controls="sidebarBaseUI"
                    class="side-nav-link">
                    <i class="ri-briefcase-line"></i>
                    <span> Base UI </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarBaseUI">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('second', ['ui', 'accordions']) }}">Accordions</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'alerts']) }}">Alerts</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'avatars']) }}">Avatars</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'buttons']) }}">Buttons</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'badges']) }}">Badges</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'breadcrumb']) }}">Breadcrumb</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'cards']) }}">Cards</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'carousel']) }}">Carousel</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'collapse']) }}">Collapse</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'dropdowns']) }}">Dropdowns</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'embed-video']) }}">Embed Video</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'grid']) }}">Grid</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'links']) }}">Links</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'list-group']) }}">List Group</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'modals']) }}">Modals</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'notifications']) }}">Notifications</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'offcanvas']) }}">Offcanvas</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'placeholders']) }}">Placeholders</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'pagination']) }}">Pagination</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'popovers']) }}">Popovers</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'progress']) }}">Progress</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'spinners']) }}">Spinners</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'tabs']) }}">Tabs</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'tooltips']) }}">Tooltips</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'typography']) }}">Typography</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['ui', 'utilities']) }}">Utilities</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarExtendedUI" aria-expanded="false"
                    aria-controls="sidebarExtendedUI" class="side-nav-link">
                    <i class="ri-compasses-2-line"></i>
                    <span> Extended UI </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarExtendedUI">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('second', ['extended', 'portlets']) }}">Portlets</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['extended', 'scrollbar']) }}">Scrollbar</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['extended', 'range-slider']) }}">Range Slider</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['extended', 'scrollspy']) }}">Scrollspy</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarIcons" aria-expanded="false" aria-controls="sidebarIcons"
                    class="side-nav-link">
                    <i class="ri-pencil-ruler-2-line"></i>
                    <span> Icons </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarIcons">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('second', ['icons', 'remixicons']) }}">Remix Icons</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['icons', 'bootstrap']) }}">Bootstrap Icons</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['icons', 'mdi']) }}">Material Design Icons</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarCharts" aria-expanded="false"
                    aria-controls="sidebarCharts" class="side-nav-link">
                    <i class="ri-donut-chart-fill"></i>
                    <span> Charts </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCharts">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('second', ['charts', 'apex']) }}">Apex Charts</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['charts', 'chartjs']) }}">Chartjs</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['charts', 'sparklines']) }}">Sparkline Charts</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarForms" aria-expanded="false" aria-controls="sidebarForms"
                    class="side-nav-link">
                    <i class="ri-survey-line"></i>
                    <span> Forms </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarForms">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('second', ['forms', 'elements']) }}">Basic Elements</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['forms', 'advanced']) }}">Form Advanced</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['forms', 'validation']) }}">Form Validation</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['forms', 'wizard']) }}">Form Wizard</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['forms', 'fileuploads']) }}">File Uploads</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['forms', 'editors']) }}">Form Editors</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['forms', 'image-crop']) }}">Image Crop</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['forms', 'x-editable']) }}">X Editable</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTables" aria-expanded="false"
                    aria-controls="sidebarTables" class="side-nav-link">
                    <i class="ri-table-line"></i>
                    <span> Tables </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTables">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('second', ['tables', 'basic']) }}">Basic Tables</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['tables', 'datatable']) }}">Data Tables</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['tables', 'editable']) }}">Editable Tables</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['tables', 'responsive']) }}">Responsive Table</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarMaps" aria-expanded="false" aria-controls="sidebarMaps"
                    class="side-nav-link">
                    <i class="ri-map-pin-line"></i>
                    <span> Maps </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMaps">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('second', ['maps', 'google']) }}">Google Maps</a>
                        </li>
                        <li>
                            <a href="{{ route('second', ['maps', 'vector']) }}">Vector Maps</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarMultiLevel" aria-expanded="false"
                    aria-controls="sidebarMultiLevel" class="side-nav-link">
                    <i class="ri-share-line"></i>
                    <span> Multi Level </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMultiLevel">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="javascript: void(0);">Level 1.1</a>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarSecondLevel" aria-expanded="false"
                                aria-controls="sidebarSecondLevel">
                                <span> Level 1.2 </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarSecondLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="javascript: void(0);">Item 1</a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);">Item 2</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarThirdLevel" aria-expanded="false"
                                aria-controls="sidebarThirdLevel">
                                <span> Level 1.3 </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarThirdLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="javascript: void(0);">Item 1</a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a data-bs-toggle="collapse" href="#sidebarFourthLevel" aria-expanded="false"
                                            aria-controls="sidebarFourthLevel">
                                            <span> Item 2 </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="sidebarFourthLevel">
                                            <ul class="side-nav-forth-level">
                                                <li>
                                                    <a href="javascript: void(0);">Item 2.1</a>
                                                </li>
                                                <li>
                                                    <a href="javascript: void(0);">Item 2.2</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->