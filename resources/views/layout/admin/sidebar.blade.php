 <!--begin::Aside-->
 <div id="kt_aside" class="aside aside-default  aside-hoverable " data-kt-drawer="true" data-kt-drawer-name="aside"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_aside_toggle">

     <!--begin::Brand-->
     <div class="aside-logo flex-column-auto px-10 pt-9 pb-5" id="kt_aside_logo">
         <!--begin::Logo-->
         <a href="{{ route('dashboard') }}">
             <img alt="Logo" src="{{ asset('assets/media/logo.webp') }}"
                 class="max-h-50px w-100 logo-default theme-light-show" />
             <img alt="Logo" src="{{ asset('assets/media/media/logo.webp') }}"
                 class="max-h-50px logo-default theme-dark-show" />
             {{-- <img alt="Logo" src="{{ asset('assets/media/logo.webp') }}"
                 class="max-h-50px logo-minimize" /> --}}
         </a>
         <!--end::Logo-->
     </div>
     <!--end::Brand-->

     <!--begin::Aside menu-->
     <div class="aside-menu flex-column-fluid ps-3 pe-1">
         <!--begin::Aside Menu-->

         <!--begin::Menu-->
         <div class="menu menu-sub-indention menu-column menu-rounded menu-title-gray-600 menu-icon-gray-400 menu-active-bg menu-state-primary menu-arrow-gray-500 fw-semibold fs-6 my-5 mt-lg-2 mb-lg-0"
             id="kt_aside_menu" data-kt-menu="true">
       

        
             <div class="hover-scroll-y mx-4" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                 data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                 data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="20px"
                 data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer">
                 @if(auth()->user()->role == 'super_admin')
                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="{{ route('dashboard') }}"><span
                    class="menu-icon"><i class="ki-duotone ki-element-11 fs-2"><span
                            class="path1"></span><span class="path2"></span><span class="path3"></span><span
                            class="path4"></span><span class="path5"></span><span
                            class="path6"></span></i></span><span
                    class="menu-title">Super Admin Dashboard</span></a><!--end:Menu link--></div>
             @endif
                 @if(auth()->user()->role == 'admin')
                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="{{ route('dashboard') }}"><span
                    class="menu-icon"><i class="ki-duotone ki-element-11 fs-2"><span
                            class="path1"></span><span class="path2"></span><span class="path3"></span><span
                            class="path4"></span><span class="path5"></span><span
                            class="path6"></span></i></span><span
                    class="menu-title">Admin Dashboard</span></a><!--end:Menu link--></div>
             @endif

             <!--begin:Menu item-->
             <div class="menu-item menu-accordion">
                <!--begin:Menu link-->
                <a href="{{route('all.users')}}">

                    <span class="menu-link {{ request()->routeIs('all.users') ? 'active' : '' }}"><span class="menu-icon"><i
                        class="bi bi-people-fill fs-2"></i></span><span class="menu-title">Users</span></span>
                </a>            
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
             <!--begin:Menu item-->
             <div class="menu-item menu-accordion">
                <!--begin:Menu link-->
                <a href="{{route('customers')}}" >

                    <span class="menu-link {{ request()->routeIs('customers') ? 'active' : '' }}"><span class="menu-icon"><i
                        class="bi bi-people fs-2"></i></span><span class="menu-title">Customers</span></span>
                </a>            
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
           
                 <!--begin:Menu item-->
                 <div class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <a href="{{route('products')}}">
                        <span class="menu-link {{ request()->routeIs('products') ? 'active' : '' }}"><span class="menu-icon"><i class="bi bi-basket fs-2"></i></span><span class="menu-title">Products</span></span>
                    </a>            
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                 <!--begin:Menu item-->
                 <div class="menu-item menu-accordion">
                    {{-- <!--begin:Menu link-->
                    <a href="{{route('all.assigned.products')}}">
                        <span class="menu-link"><span class="menu-icon"><i class="bi bi-heart fs-2"></i></span><span class="menu-title">All Favourites</span></span>
                    </a>            
                    <!--end:Menu link--> --}}
                    <!--begin:Menu link-->
                    <a href="{{route('all.favourites')}}">
                        <span class="menu-link {{ request()->routeIs('all.favourites') ? 'active' : '' }}"><span class="menu-icon"><i class="bi bi-heart fs-2"></i></span><span class="menu-title">All Favourites</span></span>
                    </a>            
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                 <!--begin:Menu item-->
                 
                 <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <!--begin:Menu link--><span class="menu-link"><span class="menu-icon"><i
                                class="bi bi-box fs-2"></i></span><span class="menu-title">Categories</span><span
                            class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion"><!--begin:Menu item-->
                    
                       
                        <div class="menu-item menu-accordion">
                            <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                    href="{{ route('categories') }}"><span class="menu-bullet"><span
                                            class="bullet bullet-dot"></span></span><span class="menu-title">Categories</span></a><!--end:Menu link--></div>
                        </div><!--end:Menu item-->
                        <div class="menu-item menu-accordion">
                            <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                    href="{{ route('subCategories') }}"><span class="menu-bullet"><span
                                            class="bullet bullet-dot"></span></span><span class="menu-title">Sub Categories</span></a><!--end:Menu link--></div>
                        </div><!--end:Menu item-->
                      
                    </div><!--end:Menu sub-->
                </div><!--end:Menu item--><!--begin:Menu item-->
                 <!--begin:Menu item-->
                 <div class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <a href="{{route('vendors')}}">
                        <span class="menu-link {{ request()->routeIs('vendors') ? 'active' : '' }}"><span class="menu-icon"><i
                            class="bi bi-people fs-2"></i></span><span class="menu-title">Vendors</span></span>
                    </a>            
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                 <!--begin:Menu item-->
                 <div class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <a href="{{route('manufacturers')}}">
                        <span class="menu-link {{ request()->routeIs('manufacturers') ? 'active' : '' }}"><span class="menu-icon"><i
                            class="bi bi-people-fill fs-2"></i></span><span class="menu-title">Manufacturers</span></span>
                    </a>            
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                 <!--begin:Menu item-->
                 <div class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <a href="{{route('paymentMethods')}}">
                        <span class="menu-link {{ request()->routeIs('paymentMethods') ? 'active' : '' }}"><span class="menu-icon"><i
                            class="bi bi-credit-card-fill fs-2"></i></span><span class="menu-title">Payment Methods</span></span>
                    </a>            
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                 {{-- <!--begin:Menu item-->
                 <div class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <a href="#">
                        <span class="menu-link"><span class="menu-icon"><i
                            class="bi bi-percent fs-2"></i></span><span class="menu-title">Sales</span></span>
                    </a>            
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item--> --}}
                 <!--begin:Menu item-->
                 <div class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <a href="{{route('invoices')}}">
                        <span class="menu-link {{ request()->routeIs('invoices') ? 'active' : '' }}"><span class="menu-icon"><i
                            class="bi bi-newspaper fs-2"></i></span><span class="menu-title">Invoices</span></span>
                    </a>            
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                 <!--begin:Menu item-->
                 <div class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <a href="{{route('drafts')}}">
                        <span class="menu-link {{ request()->routeIs('drafts') ? 'active' : '' }}"><span class="menu-icon"><i
                            class="bi bi-box-seam fs-2"></i></span><span class="menu-title"> Drafts</span></span>
                    </a>            
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                 <!--begin:Menu item-->
                 <div class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <a href="{{route('company.form')}}">
                        <span class="menu-link {{ request()->routeIs('company.form') ? 'active' : '' }}"><span class="menu-icon"><i
                            class="bi bi-buildings fs-2"></i></span><span class="menu-title">Company Details</span></span>
                    </a>            
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                 {{-- <!--begin:Menu item-->
                 <div class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <a href="#">

                        <span class="menu-link"><span class="menu-icon"><i
                            class="bi bi-gear fs-2"></i></span><span class="menu-title">Settings</span></span>
                    </a>            
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item--> --}}
                 
                
                
                <!--begin:Menu item-->
                 
                 {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                     <!--begin:Menu link--><span class="menu-link"><span class="menu-icon"><i
                                 class="ki-duotone ki-handcart fs-2"></i></span><span class="menu-title">Store
                             Management</span><span
                             class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                     <div class="menu-sub menu-sub-accordion"><!--begin:Menu item-->
                         <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                             <!--begin:Menu link-->
                             <span class="menu-link"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span
                                     class="menu-title">Products</span><span
                                     class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                             <div class="menu-sub menu-sub-accordion"><!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="{{ route('products') }}"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span class="menu-title">All
                                             Products</span></a><!--end:Menu link--></div>
                                 <!--end:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="{{ route('add.product') }}"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span class="menu-title">Add
                                             Product</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item-->
                               
                             </div><!--end:Menu sub-->
                         </div><!--end:Menu item-->
                         <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                             <!--begin:Menu link-->
                             <span class="menu-link"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span
                                     class="menu-title">Categories</span><span
                                     class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                             <div class="menu-sub menu-sub-accordion">
                                 <!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="{{ route('categories') }}"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span class="menu-title">All
                                             Categories</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item-->
                                 <!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="{{ route('add.category') }}"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span class="menu-title">Add
                                             Category</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item--><!--begin:Menu item-->

                                 <!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="{{ route('subCategories') }}"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span class="menu-title">All
                                             SubCategories</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item-->
                                 <!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="{{ route('add.subCategory') }}"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span class="menu-title">Add
                                             SubCategory</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item--><!--begin:Menu item-->

                             </div><!--end:Menu sub-->
                         </div><!--end:Menu item-->
                         <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                             <!--begin:Menu link-->
                             <span class="menu-link"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span class="menu-title">Vendors
                                 </span><span
                                     class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                             <div class="menu-sub menu-sub-accordion">
                                 <!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="{{ route('vendors') }}"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span class="menu-title">All
                                             Vendors</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item-->
                                 <!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="{{ route('add.vendor') }}"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span class="menu-title">Add
                                             Vendor</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item--><!--begin:Menu item-->



                             </div><!--end:Menu sub-->
                         </div><!--end:Menu item-->
                         <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                             <!--begin:Menu link-->
                             <span class="menu-link"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span
                                     class="menu-title">Manufacturers
                                 </span><span
                                     class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                             <div class="menu-sub menu-sub-accordion">


                                 <!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="{{ route('manufacturers') }}"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span class="menu-title">All
                                             Manufacturer</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item-->
                                 <!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="{{ route('add.manufacturer') }}"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span class="menu-title">Add
                                             Manufacturer</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item--><!--begin:Menu item-->

                             </div><!--end:Menu sub-->
                         </div><!--end:Menu item-->
                         <!--begin:Menu item-->
                         <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                             <!--begin:Menu link--><span class="menu-link"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span
                                     class="menu-title">Sales</span><span
                                     class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                             <div class="menu-sub menu-sub-accordion"><!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="apps/ecommerce/sales/listing.html"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span
                                             class="menu-title">Orders Listing</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item--><!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="apps/ecommerce/sales/details.html"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span
                                             class="menu-title">Order Details</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item--><!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="apps/ecommerce/sales/add-order.html"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span class="menu-title">Add
                                             Order</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item--><!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="apps/ecommerce/sales/edit-order.html"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span class="menu-title">Edit
                                             Order</span></a><!--end:Menu link-->
                                 </div><!--end:Menu item-->
                             </div><!--end:Menu sub-->
                         </div><!--end:Menu item--><!--begin:Menu item-->
                         <div class="menu-item menu-accordion">
                             <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                     href="{{ route('paymentMethods') }}"><span class="menu-bullet"><span
                                             class="bullet bullet-dot"></span></span><span class="menu-title">Payment
                                         Methods </span></a><!--end:Menu link--></div>
                        
                         </div><!--end:Menu item--><!--begin:Menu item-->
                         <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                             <!--begin:Menu link--><span class="menu-link"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span
                                     class="menu-title">Reports</span><span
                                     class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                             <div class="menu-sub menu-sub-accordion"><!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="apps/ecommerce/reports/view.html"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span
                                             class="menu-title">Products
                                             Viewed</span></a><!--end:Menu link--></div>
                                 <!--end:Menu item--><!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="apps/ecommerce/reports/sales.html"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span
                                             class="menu-title">Sales</span></a><!--end:Menu link--></div>
                                 <!--end:Menu item--><!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="apps/ecommerce/reports/returns.html"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span
                                             class="menu-title">Returns</span></a><!--end:Menu link--></div>
                                 <!--end:Menu item--><!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="apps/ecommerce/reports/customer-orders.html"><span
                                             class="menu-bullet"><span class="bullet bullet-dot"></span></span><span
                                             class="menu-title">Customer
                                             Orders</span></a><!--end:Menu link--></div>
                                 <!--end:Menu item--><!--begin:Menu item-->
                                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                         href="apps/ecommerce/reports/shipping.html"><span class="menu-bullet"><span
                                                 class="bullet bullet-dot"></span></span><span
                                             class="menu-title">Shipping</span></a><!--end:Menu link--></div>
                                 <!--end:Menu item-->
                             </div><!--end:Menu sub-->
                         </div><!--end:Menu item--><!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="apps/ecommerce/settings.html"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span
                                     class="menu-title">Settings</span></a><!--end:Menu link--></div>
                         <!--end:Menu item-->
                     </div><!--end:Menu sub-->
                 </div> --}}
                 
                 <!--end:Menu item-->
                 
                 <!--begin:Menu item-->

                 {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                     <!--begin:Menu link--><span class="menu-link"><span class="menu-icon"><i
                                 class="ki-duotone ki-shield-tick fs-2"><span class="path1"></span><span
                                     class="path2"></span></i></span><span class="menu-title">User
                             Management</span><span
                             class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                     <div class="menu-sub menu-sub-accordion"><!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="{{ route('all.users') }}"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span class="menu-title">All
                                     Users</span></a><!--end:Menu link-->
                         </div><!--end:Menu item-->
                        
                     </div><!--end:Menu sub-->
                 </div><!--end:Menu item--><!--begin:Menu item-->
                 <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                     <!--begin:Menu link--><span class="menu-link"><span class="menu-icon"><i
                                 class="ki-duotone ki-briefcase fs-2"><span class="path1"></span><span
                                     class="path2"></span></i></span><span class="menu-title">Customers</span><span
                             class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                     <div class="menu-sub menu-sub-accordion">
                       
                         <!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="{{ route('customers') }}"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span class="menu-title">All
                                     Customers
                                 </span></a><!--end:Menu link--></div>
                         <!--end:Menu item-->
                       
                     </div><!--end:Menu sub-->
                 </div> --}}

                 <!--end:Menu item-->
                 
                 <!--begin:Menu item-->
                 {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                     <!--begin:Menu link--><span class="menu-link"><span class="menu-icon"><i
                                 class="ki-duotone ki-file-added fs-2"><span class="path1"></span><span
                                     class="path2"></span></i></span><span class="menu-title">File
                             Manager</span><span
                             class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                     <div class="menu-sub menu-sub-accordion"><!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="apps/file-manager/folders.html"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span
                                     class="menu-title">Folders</span></a><!--end:Menu link--></div>
                         <!--end:Menu item--><!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="apps/file-manager/files.html"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span
                                     class="menu-title">Files</span></a><!--end:Menu link--></div>
                         <!--end:Menu item--><!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="apps/file-manager/blank.html"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span class="menu-title">Blank
                                     Directory</span></a><!--end:Menu link--></div>
                         <!--end:Menu item--><!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="apps/file-manager/settings.html"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span
                                     class="menu-title">Settings</span></a><!--end:Menu link--></div>
                         <!--end:Menu item-->
                     </div><!--end:Menu sub-->
                 </div><!--end:Menu item--><!--begin:Menu item-->
                 <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                     <!--begin:Menu link--><span class="menu-link"><span class="menu-icon"><i
                                 class="ki-duotone ki-sms fs-2"><span class="path1"></span><span
                                     class="path2"></span></i></span><span class="menu-title">Inbox</span><span
                             class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                     <div class="menu-sub menu-sub-accordion"><!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="apps/inbox/listing.html"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span
                                     class="menu-title">Messages</span><span class="menu-badge"><span
                                         class="badge badge-success">3</span></span></a><!--end:Menu link-->
                         </div><!--end:Menu item--><!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="apps/inbox/compose.html"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span
                                     class="menu-title">Compose</span></a><!--end:Menu link--></div>
                         <!--end:Menu item--><!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="apps/inbox/reply.html"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span class="menu-title">View &
                                     Reply</span></a><!--end:Menu link--></div>
                         <!--end:Menu item-->
                     </div><!--end:Menu sub-->
                 </div><!--end:Menu item--><!--begin:Menu item-->
                 <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                     <!--begin:Menu link--><span class="menu-link"><span class="menu-icon"><i
                                 class="ki-duotone ki-message-text-2 fs-2"><span class="path1"></span><span
                                     class="path2"></span><span class="path3"></span></i></span><span
                             class="menu-title">Chat</span><span
                             class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                     <div class="menu-sub menu-sub-accordion"><!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="apps/chat/private.html"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span class="menu-title">Private
                                     Chat</span></a><!--end:Menu link--></div>
                         <!--end:Menu item--><!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="apps/chat/group.html"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span class="menu-title">Group
                                     Chat</span></a><!--end:Menu link--></div>
                         <!--end:Menu item--><!--begin:Menu item-->
                         <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                                 href="apps/chat/drawer.html"><span class="menu-bullet"><span
                                         class="bullet bullet-dot"></span></span><span class="menu-title">Drawer
                                     Chat</span></a><!--end:Menu link--></div>
                         <!--end:Menu item-->
                     </div><!--end:Menu sub-->
                 </div><!--end:Menu item--><!--begin:Menu item--> --}}
                 {{-- <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                         href="{{ route('calendar') }}"><span class="menu-icon"><i
                                 class="ki-duotone ki-calendar-8 fs-2"><span class="path1"></span><span
                                     class="path2"></span><span class="path3"></span><span
                                     class="path4"></span><span class="path5"></span><span
                                     class="path6"></span></i></span><span
                             class="menu-title">Calendar</span></a><!--end:Menu link--></div> --}}
                 <!--end:Menu item-->
                 {{-- <!--begin:Menu item-->
                 <div class="menu-item"><!--begin:Menu content-->
                     <div class="menu-content">
                         <div class="separator mx-1 my-4"></div>
                     </div><!--end:Menu content-->
                 </div><!--end:Menu item--><!--begin:Menu item-->
                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                         href="https://preview.keenthemes.com/html/craft/docs/base/utilities" target="_blank"><span
                             class="menu-icon"><i class="ki-duotone ki-row-vertical fs-2"><span
                                     class="path1"></span><span class="path2"></span></i></span><span
                             class="menu-title">Components</span></a><!--end:Menu link--></div>
                 <!--end:Menu item--><!--begin:Menu item-->
                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                         href="https://preview.keenthemes.com/html/craft/docs" target="_blank"><span
                             class="menu-icon"><i class="ki-duotone ki-abstract-41 fs-2"><span
                                     class="path1"></span><span class="path2"></span></i></span><span
                             class="menu-title">Documentation</span></a><!--end:Menu link--></div>
                 <!--end:Menu item--><!--begin:Menu item-->
                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                         href="layout-builder.html"><span class="menu-icon"><i
                                 class="ki-duotone ki-abstract-13 fs-2"><span class="path1"></span><span
                                     class="path2"></span></i></span><span class="menu-title">Layout
                             Builder</span></a><!--end:Menu link--></div>
                 <!--end:Menu item--><!--begin:Menu item-->
                 <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                         href="https://preview.keenthemes.com/html/craft/docs/getting-started/changelog"
                         target="_blank"><span class="menu-icon"><i class="ki-duotone ki-code fs-2"><span
                                     class="path1"></span><span class="path2"></span><span
                                     class="path3"></span><span class="path4"></span></i></span><span
                             class="menu-title">Changelog <span
                                 class="badge badge-changelog badge-light-success bg-hover-danger text-hover-white fw-bold fs-9 px-2 ms-2">v1.1.3</span></span></a><!--end:Menu link-->
                 </div><!--end:Menu item--> --}}
             </div>
         </div>
         <!--end::Menu-->
     </div>
     <!--end::Aside menu-->

     <!--begin::Footer-->
     <div class="aside-footer flex-column-auto pb-5 d-none" id="kt_aside_footer">
         <a href="#" class="btn btn-light-primary w-100">
             Button
         </a>
     </div>
     <!--end::Footer-->
 </div>
 <!--end::Aside-->
