CREATE TABLE  kt_goods (
  goods_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  goods_name VARCHAR(45) NOT NULL ,
  goods_sn VARCHAR(45) NOT NULL ,
  market_price DECIMAL(10,2) NOT NULL DEFAULT 0,
  shop_price DECIMAL(10,2) NOT NULL DEFAULT 0,
  goods_img VARCHAR(45) NOT NULL,
  goods_thumb VARCHAR(45) NOT NULL,
  goods_desc TEXT NOT NULL ,
  is_best TINYINT(3) NOT NULL DEFAULT 0,
  is_hot TINYINT(3) NOT NULL DEFAULT 0,
  is_new TINYINT(3) NOT NULL DEFAULT 0,
  is_onsale TINYINT(3) NOT NULL DEFAULT 0,
  add_time INT NOT NULL DEFAULT 0,
  brand_id INT NOT NULL,
  cat_id INT NOT NULL ,
  FOREIGN KEY (brand_id) REFERENCES kt_brand(brand_id),
  FOREIGN KEY (cat_id) REFERENCES  kt_category(cat_id)
);

CREATE TABLE kt_brand(
  brand_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  brand_name VARCHAR(45) NOT NULL ,
  brand_logo VARCHAR(45) NOT NULL ,
  brand_desc VARCHAR(45) NOT NULL
);
CREATE TABLE kt_category(
  cat_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  cat_name VARCHAR(45) NOT NULL ,
  cat_desc VARCHAR(45) NOT NULL ,
  unit VARCHAR(10) NOT NULL ,
  sort_order TINYINT(3) NOT NULL DEFAULT 0,
  is_show TINYINT(3) NOT NULL DEFAULT 1,
  parent_id INT NOT NULL DEFAULT 0
);
CREATE TABLE kt_attribute(
  attr_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  attr_name VARCHAR(45) NOT NULL ,
  attr_type TINYINT(3) NOT NULL ,
  attr_input_type TINYINT(3) NOT NULL ,
  attr_value VARCHAR(45) NOT NULL,
  type_id INT NOT NULL ,
  sort_order TINYINT NOT NULL DEFAULT 50,
  FOREIGN KEY (type_id) REFERENCES kt_goods_type(type_id)
);
CREATE TABLE kt_goods_attr(
  rec_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  goods_id INT NOT NULL ,
  attr_id INT NOT NULL ,
  attr_value VARCHAR(45) NOT NULL ,
  FOREIGN KEY (goods_id) REFERENCES kt_goods(goods_id),
  FOREIGN KEY (attr_id) REFERENCES kt_attribute(attr_id)
);
CREATE TABLE kt_goods_type(
  type_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  type_name VARCHAR(45) NOT NULL
);
CREATE TABLE kt_admin(
  admin_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  admin_name VARCHAR(45) NOT NULL ,
  admin_password VARCHAR(45) NOT NULL ,
  admin_email VARCHAR(45),
  add_time INT NOT NULL DEFAULT 0
);
SHOW TABLES ;