<table id="{{ attr_id('datagrid') }}">
    <thead>
    <tr>
        <th data-options="field:'id',width:60,sortable:true">ID</th>
        <th data-options="field:'name',width:100,sortable:true">名称</th>
        <th data-options="field:'description',width:300,sortable:false">描述</th>
        <th data-options="field:'created_at',width:100,sortable:true">创建时间</th>
        <th data-options="field:'updated_at',width:100,sortable:true">更新时间</th>
    </tr>
    </thead>
</table>

{{--顶部工具栏--}}
<div id="{{ attr_id('datagrid.toolbar') }}">
    {!! module_toolbar() !!}

    {{--自定义不用控制权限的功能--}}
    <a class="easyui-linkbutton handle" handle="refresh" iconCls="fa fa-refresh" plain="true">刷新</a>
</div>

{{--右键菜单--}}
@if(module_menu())
    <div id="{{ attr_id('datagrid.menu') }}" class="easyui-menu">
        {!! module_menu() !!}
    </div>
@endif

<script type="text/javascript">
    $.cumuli.datagrid
        .init('#{{ attr_id('datagrid') }}', {
            title: '{{ breadcrumbs() }}',
            iconCls: '{{ $action['icon'] }}',
            url: '{{ $action['url'] }}',
            toolbar: '#{{ attr_id('datagrid.toolbar') }}',
            menu: '#{{ attr_id('datagrid.menu') }}',
        })
        .filter([
            {
                field: 'id',
                type: 'numberbox',
                options: {min: 0},
                op: ['equal', 'notequal', 'less', 'lessorequal', 'greater', 'greaterorequal']
            },
            {
                field: 'name',
                type: 'textbox',
                options: {},
                op: ['contains', 'beginwith', 'endwith']
            },
            {
                field: 'description',
                type: 'textbox',
                options: {},
                op: ['contains', 'beginwith', 'endwith']
            },
            {
                field: 'created_at',
                type: 'datetimebox',
                options: {editable: false},
                op: ['equal', 'notequal', 'less', 'greater']
            },
            {
                field: 'updated_at',
                type: 'datetimebox',
                options: {editable: false},
                op: ['equal', 'notequal', 'less', 'greater']
            }
        ])
        .handle({
            create: function (e, row, rows, option) {
                console.log('create', [e, row, rows, option]);
                $.cumuli.dialog.form(e, {
                    href: '/system/role/create',
                    width: 400,
                    height: 300,
                });
            },

            update: function (e, row, rows, option) {
                console.log('update', e);

                if (!row) {
                    $.cumuli.message.show('未选择数据', 'error');
                    return false;
                }

                $.cumuli.dialog.form(e, {
                    href: '/system/role/update?id=' + row.id,
                    width: 400,
                    height: 300,
                });
            },

            delete: function (e, row, rows, option) {
                console.log('delete', e);

                if (!row) {
                    $.cumuli.message.show('未选择数据', 'error');
                    return false;
                }

                var that = this;
                $.messager.confirm('系统提示', '确定要继续吗？', function (res) {
                    if (!res) return false;

                    $.cumuli.request.post('/system/role/delete', {id: row.id}, function (data) {
                        if (data.status == 'error') {
                            return $.cumuli.message.show(data.message, 'error');
                        }
                        that.refresh();
                    });
                });
            },

            //刷新
            refresh: function () {
                $('#{{ attr_id('datagrid') }}').datagrid('reload');
            },
        });
</script>
