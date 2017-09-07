//goods表

create table goods(
	goods_id int auto_increment primary key,
	goods_name varchar(50) not null comment '商品名称',
	price decimal(10,2) default 0,
	market_price decimal(10,2) default 0 comment '市场价',
	stock_num int default 0 comment '库存',
	is_show tinyint(1) unsigned default 1 comment '是否显示',
	status set('精品','热销','新品'),
	image_original varchar(100) comment '原始图片路径',
	image_small varchar(100) comment '缩略图路径',
	image_stamp varchar(100) comment '水印图路径',
	time_original datetime comment '上传时间',
	time_modify datetime comment '修改时间',
	admin_user varchar(20),
	detail text comment '商品详细信息,text可存6万多字节'
) charset=utf8;