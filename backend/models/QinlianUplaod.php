<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "qinlian_annex".
 */
class QinlianUplaod extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qinlian_uplaod';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date', 'update_time'], 'safe'],
            [['table_id', 'del_status'], 'integer'],
            [['table_name', 'url', 'code'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_id' => '关联表ID',
            'table_name' => '关联表名',
            'url' => 'URL',
            'code' => '文件编号',
            'del_status' => '删除状态',
            'create_date' => '创建时间',
            'update_time' => '更新时间',
        ];
    }

  /**
     * 返回数据库字段信息，仅在生成CRUD时使用，如不需要生成CRUD，请注释或删除该getTableColumnInfo()代码
     * COLUMN_COMMENT可用key如下:
     * label - 显示的label
     * inputType 控件类型, 暂时只支持text,hidden  // select,checkbox,radio,file,password,
     * isEdit   是否允许编辑，如果允许编辑将在添加和修改时输入
     * isSearch 是否允许搜索
     * isDisplay 是否在列表中显示
     * isOrder 是否排序
     * udc - udc code，inputtype为select,checkbox,radio三个值时用到。
     * 特别字段：
     * id：主键。必须含有主键，统一都是id
     * create_date: 创建时间。生成的代码自动赋值
     * update_date: 修改时间。生成的代码自动赋值
     */
    public function getTableColumnInfo(){
        return array(
        'id' => array(
                        'name' => 'id',
                        'allowNull' => false,
//                         'autoIncrement' => true,
//                         'comment' => 'ID',
//                         'dbType' => "mediumint(8) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'integer',
                        'precision' => '8',
                        'scale' => '',
                        'size' => '8',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('id'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),


        'table_id' => array(
            'name' => 'table_id',
            'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '关联表ID',
//                         'dbType' => "int(3)",
            'defaultValue' => '0',
            'enumValues' => null,
            'isPrimaryKey' => false,
            'phpType' => 'integer',
            'precision' => '8',
            'scale' => '',
            'size' => '8',
            'type' => 'integer',
            'unsigned' => false,
            'label'=>$this->getAttributeLabel('table_id'),
            'inputType' => 'text',
            'isEdit' => true,
            'isSearch' => false,
            'isDisplay' => true,
            'isSort' => true,
//                         'udc'=>'',
        ),


		'table_name' => array(
            'name' => 'table_name',
            'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '关联表名',
//                         'dbType' => "varchar(60)",
            'defaultValue' => '',
            'enumValues' => null,
            'isPrimaryKey' => false,
            'phpType' => 'string',
            'precision' => '60',
            'scale' => '',
            'size' => '60',
            'type' => 'string',
            'unsigned' => false,
            'label'=>$this->getAttributeLabel('table_name'),
            'inputType' => 'text',
            'isEdit' => true,
            'isSearch' => false,
            'isDisplay' => true,
            'isSort' => true,
//                         'udc'=>'',
        ),


        'url' => array(
            'name' => 'url',
            'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => 'URL',
//                         'dbType' => "varchar(60)",
            'defaultValue' => '',
            'enumValues' => null,
            'isPrimaryKey' => false,
            'phpType' => 'string',
            'precision' => '60',
            'scale' => '',
            'size' => '60',
            'type' => 'string',
            'unsigned' => false,
            'label'=>$this->getAttributeLabel('url'),
            'inputType' => 'text',
            'isEdit' => true,
            'isSearch' => false,
            'isDisplay' => true,
            'isSort' => true,
//                         'udc'=>'',
        ),
            'code' => array(
                'name' => 'code',
                'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '文件编号',
//                         'dbType' => "timestamp",
                'defaultValue' => '',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'string',
                'precision' => '',
                'scale' => '',
                'size' => '30',
                'type' => 'string',
                'unsigned' => false,
                'label'=>$this->getAttributeLabel('code'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => false,
                'isDisplay' => true,
                'isSort' => true,
//                         'udc'=>'',
            ),

		'del_status' => array(
                        'name' => 'del_status',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '删除状态',
//                         'dbType' => "int(1)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '1',
                        'scale' => '',
                        'size' => '1',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('del_status'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'create_date' => array(
                        'name' => 'create_date',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '创建时间',
//                         'dbType' => "timestamp",
                        'defaultValue' => 'CURRENT_TIMESTAMP',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'timestamp',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('create_date'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'update_time' => array(
                        'name' => 'update_time',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '更新时间',
//                         'dbType' => "timestamp",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'timestamp',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('update_time'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		        );
        
    }
 
}
