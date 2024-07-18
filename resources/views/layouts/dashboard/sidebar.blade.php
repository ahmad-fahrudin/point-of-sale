        <div class="left-side-menu">
            <div class="h-100" data-simplebar>
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <ul id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="{{ route('index') }}">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span> Dashboards </span>
                            </a>
                        </li>
                        @if (Auth::User()->can('pos.menu'))
                            <li>
                                <a href="{{ route('pos') }}">
                                    <span class="badge bg-info float-end">Hot</span>
                                    <i class="mdi mdi-shopping-outline"></i>
                                    <span> POS </span>
                                </a>
                            </li>
                        @endif

                        <li class="menu-title mt-2">Merchandise</li>
                        @if (Auth::User()->can('category.menu'))
                            <li>
                                <a href="#category" data-bs-toggle="collapse">
                                    <i class="mdi mdi-view-grid-outline"></i>
                                    <span>Category</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="category">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.category') }}">All Category</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (Auth::User()->can('product.menu'))
                            <li>
                                <a href="#product" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cube-outline"></i>
                                    <span>Product</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="product">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.product') }}">All Product</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.product') }}">Add Product</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (Auth::User()->can('order.menu'))
                            <li>
                                <a href="#orders" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cart-outline"></i>
                                    <span>Orders</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="orders">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('pending.order') }}">Pending Orders</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('complete.order') }}">Complete Orders </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('pending.due') }}">Pending Due </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (Auth::User()->can('stock.menu'))
                            <li>
                                <a href="#stock" data-bs-toggle="collapse">
                                    <i class="mdi mdi-folder-open-outline"></i>
                                    <span>Stock Manage</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="stock">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('stock.manage') }}">Stock</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        <li class="menu-title mt-2">Management</li>
                        @if (Auth::User()->can('employee.menu'))
                            <li>
                                <a href="#sidebarEmployee" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-circle-outline"></i>
                                    <span>Employee Manage</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEmployee">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.employee') }}">All Employee</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.employee') }}">Add Employee</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (Auth::User()->can('customer.menu'))
                            <li>
                                <a href="#sidebarCustomer" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-group-outline"></i>
                                    <span>Customer Manage</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCustomer">
                                    <ul class="nav-second-level">
                                        {{-- @if (Auth::User()->can('all.customer')) --}}
                                        <li>
                                            <a href="{{ route('all.customer') }}">All Customer</a>
                                        </li>
                                        {{-- @endif --}}
                                        {{-- @if (Auth::User()->can('add.customer')) --}}
                                        <li>
                                            <a href="{{ route('add.customer') }}">Add Customer</a>
                                        </li>
                                        {{-- @endif --}}
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (Auth::User()->can('supplier.menu'))
                            <li>
                                <a href="#sidebarSupplier" data-bs-toggle="collapse">
                                    <i class="mdi mdi-truck-outline"></i>
                                    <span>Supplier Manage</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSupplier">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.supplier') }}">All Supplier</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.supplier') }}">Add Supplier</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (Auth::User()->can('salary.menu'))
                            <li>
                                <a href="#sidebarSalary" data-bs-toggle="collapse">
                                    <i class="mdi mdi-bank-outline"></i>
                                    <span>Employee Salary</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSalary">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('add.advance.salary') }}">Add Advance Salary</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('all.advance.salary') }}">All Advance Salary</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('pay.salary') }}">Pay Salary</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('month.salary') }}">Last Month Salary</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (Auth::User()->can('expense.menu'))
                            <li>
                                <a href="#expense" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-edit-outline"></i>
                                    <span>Expense</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="expense">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('add.expense') }}">Add Expense</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('today.expense') }}">Today Expense</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('month.expense') }}">Monthly Expense</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('year.expense') }}">Yearly Expense</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (Auth::User()->can('attendance.menu'))
                            <li>
                                <a href="#sidebarAttend" data-bs-toggle="collapse">
                                    <i class="mdi mdi-calendar-month-outline"></i>
                                    <span>Employee Attendance</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarAttend">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('employee.attend.list') }}">Employee Attendance List</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.employee.attend') }}">Add Employee Attendance</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        <li class="menu-title mt-2">Others</li>
                        @if (Auth::User()->can('roles.menu'))
                            <li>
                                <a href="#permission" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cog-sync-outline"></i>
                                    <span> Roles And Permission </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="permission">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.permission') }}">All Permission </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.permission') }}">Add Permission </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('all.roles') }}">All Roles </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.roles.permission') }}">Roles in Permission </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('all.roles.permission') }}">All Roles in Permission </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (Auth::User()->can('admin.menu'))
                            <li>
                                <a href="#admin" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-lock-outline"></i>
                                    <span> Admin User </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="admin">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.user') }}">All Admin </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.user') }}">Add Admin </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (Auth::User()->can('db.menu'))
                            <li>
                                <a href="#backup" data-bs-toggle="collapse">
                                    <i class="mdi mdi-database-outline"></i>
                                    <span>Database Backup </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="backup">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('database.backup') }}">Database Backup </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                        @endif
                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
