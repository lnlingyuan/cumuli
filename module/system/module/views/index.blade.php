<table
    id="{{ attr_id('datagrid') }}"
    data-menu="#{{ attr_id('datagrid.menu') }}"
    data-toolbar="#{{ attr_id('datagrid.toolbar') }}"
    data-title="{{ trans('module.'. array_get($module, 'group')) }}/{{ array_get($module, 'composer.extra.module.name') }}"
    data-url="{{ array_get($module, 'url') }}"
    iconCls="{{ array_get($module, 'composer.extra.module.icon') }}">

    <thead>
    <tr>
        <th data-options="field:'name',width:20,sortable:false">模块</th>
        <th data-options="field:'path',width:50,sortable:false">目录</th>
        <th data-options="field:'composer',width:100,sortable:false,formatter:function(value,row,index){return  JSON.stringify(value)}">
            Composer配置
        </th>
    </tr>
    </thead>
</table>

{{--顶部工具栏--}}
<div id="{{ attr_id('datagrid.toolbar') }}">
    <a class="easyui-linkbutton" iconCls="fa fa-plus" plain="true">添加</a>
    <a class="easyui-linkbutton" iconCls="fa fa-edit" plain="true">编辑</a>
    <a class="easyui-linkbutton" iconCls="fa fa-minus" plain="true">删除</a>
</div>

{{--右键菜单--}}
<div id="{{ attr_id('datagrid.menu') }}" class="easyui-menu">
    <div iconCls="fa fa-edit">编辑</div>
    <div iconCls="fa fa-minus">删除</div>
</div>

<script type="text/javascript">
    $.cumuli.datagrid.init('#{{ attr_id('datagrid') }}', {
        singleSelect: true,
        view: $.cumuli.variable.datagrid.detailview,

        detailFormatter: function (rowIndex, rowData) {
            return '<pre>' + JSON.stringify(rowData, null, '  ') + '</pre>';
        },

        groupField: 'group',
        groupFormatter: function (value, rows) {
            return value + ' - ' + rows.length + ' Item(s)';
        }
    });
</script>
