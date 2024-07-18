<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\AttendenceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware(['auth'])->group(function () {
    // AdminController All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('admin/logout', 'adminLogout')->name('admin.logout');
        Route::get('/logout', 'logoutPage')->name('logout.page');
        Route::get('/change/password', 'changePassword')->name('change.password');
        Route::post('/update/password', 'updatePassword')->name('update.password');
        Route::get('/admin/profile', 'adminProfile')->name('admin.profile');
        Route::post('/admin/store', 'adminStore')->name('admin.store');
    });

    // Employee All Route
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('all/employee', 'allEmployee')->name('all.employee');
        Route::get('add/employee', 'addEmployee')->name('add.employee');

        Route::post('/employee/store', 'storeEmployee')->name('employee.store');
        Route::get('/employee/edit/{id}', 'editEmployee')->name('employee.edit');
        Route::post('/employee/update', 'updateEmployee')->name('employee.update');
        Route::get('/employee/delete/{id}', 'deleteEmployee')->name('employee.delete');
    });

    // Customer All Route
    Route::controller(CustomerController::class)->group(function () {
        Route::get('all/customer', 'allCustomer')->name('all.customer');
        Route::get('add/customer', 'addCustomer')->name('add.customer');

        Route::post('/customer/store', 'storeCustomer')->name('customer.store');
        Route::get('/customer/edit/{id}', 'editCustomer')->name('customer.edit');
        Route::post('/customer/update', 'updateCustomer')->name('customer.update');
        Route::get('/customer/delete/{id}', 'deleteCustomer')->name('customer.delete');
    });

    // Supplier All Route
    Route::controller(SupplierController::class)->group(function () {
        Route::get('all/supplier', 'allsupplier')->name('all.supplier');
        Route::get('add/supplier', 'addsupplier')->name('add.supplier');

        Route::post('/supplier/store', 'storesupplier')->name('supplier.store');
        Route::get('/supplier/edit/{id}', 'editsupplier')->name('supplier.edit');
        Route::post('/supplier/update', 'updatesupplier')->name('supplier.update');
        Route::get('/supplier/delete/{id}', 'deletesupplier')->name('supplier.delete');

        Route::get('/supplier/detail/{id}', 'detailsupplier')->name('supplier.detail');
    });

    // Advance Salary All Route
    Route::controller(SalaryController::class)->group(function () {
        Route::get('add/advance/salary', 'addAdvanceSalary')->name('add.advance.salary');
        Route::post('advance/salary/store', 'AdvanceSalaryStore')->name('advance.salary.store');
        Route::get('all/advance/salary', 'allAdvanceSalary')->name('all.advance.salary');

        Route::get('edit/advance/salary/{id}', 'editAdvanceSalary')->name('edit.advance.salary');
        Route::post('advance/salary/update', 'AdvanceSalaryUpdate')->name('advance.salary.update');
        Route::get('delete/advance/salary/{id}', 'deleteAdvanceSalary')->name('delete.advance.salary');
    });

    // Pay Salary All Route
    Route::controller(SalaryController::class)->group(function () {
        Route::get('pay/salary', 'paySalary')->name('pay.salary');
        Route::get('pay/now/salary/{id}', 'payNowSalary')->name('pay.now.salary');
        Route::post('employee/salary/store', 'employeeSalaryStore')->name('employee.salary.store');

        Route::get('month/salary', 'monthSalary')->name('month.salary');
        Route::get('history/salary/{id}', 'historySalary')->name('history.salary');
    });

    // Attendance All Route
    Route::controller(AttendenceController::class)->group(function () {
        Route::get('employee/attend/list', 'employeeAttendList')->name('employee.attend.list');
        Route::get('add/employee/attend', 'addEmployeeAttend')->name('add.employee.attend');
        Route::post('employee/attend/store', 'employeeAttendStore')->name('employee.attend.store');

        Route::get('employee/attend/edit/{date}', 'employeeAttendEdit')->name('employee.attend.edit');
        Route::post('employee/attend/update', 'employeeAttendUpdate')->name('employee.attend.update');
        Route::get('employee/attend/details/{date}', 'employeeAttendDetails')->name('employee.attend.details');
    });

    // Category All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('all/category', 'allCategory')->name('all.category');
        Route::get('category/store', 'categoryStore')->name('category.store');

        Route::get('/category/edit/{id}', 'editCategory')->name('category.edit');
        Route::post('/category/update', 'updateCategory')->name('category.update');
        Route::get('/category/delete/{id}', 'deleteCategory')->name('category.delete');
    });

    // product All Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('all/product', 'allProduct')->name('all.product');
        Route::get('add/product', 'addProduct')->name('add.product');

        Route::post('/product/store', 'storeProduct')->name('product.store');
        Route::get('/product/edit/{id}', 'editProduct')->name('product.edit');
        Route::post('/product/update', 'updateProduct')->name('product.update');
        Route::get('/product/delete/{id}', 'deleteProduct')->name('product.delete');

        Route::get('/product/barcode/{id}', 'barcodeProduct')->name('product.barcode');
    });


    // expense All Route
    Route::controller(ExpenseController::class)->group(function () {
        Route::get('add/expense', 'addExpense')->name('add.expense');
        Route::post('/expense/store', 'storeExpense')->name('expense.store');
        Route::get('today/expense', 'todayExpense')->name('today.expense');

        Route::get('/expense/edit/{id}', 'editExpense')->name('expense.edit');
        Route::post('/expense/update', 'updateExpense')->name('expense.update');
        Route::get('month/expense', 'monthExpense')->name('month.expense');
        Route::get('year/expense', 'yearExpense')->name('year.expense');
    });

    // pos All Route
    Route::controller(PosController::class)->group(function () {
        Route::get('pos', 'pos')->name('pos');
        Route::post('/add-cart', 'addCart');
        Route::get('/allitem', 'allItem');
        Route::post('/cart-update/{rowId}', 'updateCart');
        Route::get('/cart-delete/{rowId}', 'deleteCart');

        Route::post('/create-invoice', 'createInvoice');
    });

    // Order All Route
    Route::controller(OrderController::class)->group(function () {
        Route::post('/final-invoice', 'finalInvoice')->name('final.invoice');

        Route::get('/pending/order', 'pendingOrder')->name('pending.order');
        Route::get('/order/details/{order_id}', 'orderDetails')->name('order.details');

        Route::post('/order/status/update', 'orderStatusUpdate')->name('order.status.update');
        Route::get('/complete/order', 'completeOrder')->name('complete.order');

        Route::get('/stock', 'stockManage')->name('stock.manage');
        Route::get('/order/invoice-download/{order_id}', 'orderInvoice');
        //// Due All Route
        Route::get('/pending/due', 'PendingDue')->name('pending.due');
        Route::get('/order/due/{id}', 'OrderDueAjax');
        Route::post('/update/due', 'UpdateDue')->name('update.due');
    });

    ///Permission All Route
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission', 'StorePermission')->name('permission.store');

        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('permission.update');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
    });

    ///Roles All Route
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/roles', 'AllRoles')->name('all.roles');
        Route::get('/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/store/roles', 'StoreRoles')->name('roles.store');
        Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');

        Route::post('/update/roles', 'UpdateRoles')->name('roles.update');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');
    });

    ///Add Roles in Permission All Route
    Route::controller(RoleController::class)->group(function () {
        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'StoreRolesPermission')->name('role.permission.store');
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');

        Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
        Route::post('/role/permission/update/{id}', 'RolePermissionUpdate')->name('role.permission.update');
        Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');
    });

    ///User Admin All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/user', 'AllUser')->name('all.user');
        Route::get('/add/user', 'AddUser')->name('add.user');

        Route::post('/store/user', 'StoreUser')->name('user.store');
        Route::get('/edit/user/{id}', 'EditUser')->name('user.edit');
        Route::post('/update/user', 'UpdateUser')->name('user.update');
        Route::get('/delete/user/{id}', 'DeleteUser')->name('user.delete');

        // Database Backup
        Route::get('/database/backup', 'DatabaseBackup')->name('database.backup');
        Route::get('/backup/now', 'BackupNow');
        Route::get('{getFilename}', 'DownloadDatabase');
        Route::get('/delete/database/{getFilename}', 'DeleteDatabase');
    });
});
