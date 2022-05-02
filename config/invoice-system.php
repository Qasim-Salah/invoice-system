<?php

return [
    'invoice_type' => [
        ['name' => 'مدفوعة', 'id' => 1, 'class' => 'badge bg-success font-size-15'],
        ['name' => 'غير مدفوعة', 'id' => 2, 'class' => 'badge bg-danger font-size-15'],
        ['name' => 'مدفوعة جزئيآ', 'id' => 3, 'class' => 'badge bg-warning font-size-15'],
    ],
    'permissions' => [
        'invoices' => 'التحكم بالفواتير  ',
        'invoices-archive' => 'التحكم بالفواتير المؤرشفة',
        'reports' => 'التحكم بالتقارير ',
        'users' => 'التحكم  بمستخدمي اللوحه',
        'settings' => 'التحكم بالاعدادات',
        'roles' => 'التحكم بالصلاحيات',
    ]
];
