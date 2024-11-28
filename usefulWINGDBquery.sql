select * from reviews;


insert into reviews values ('1','1','1','1','1','1','1','1','1','1',now(),'1');

select * from wingtheory_test.markers

select * from reviews

select avg(size),avg(crisp),avg(num_sauce),avg(sauce_quality),avg(sauce_amount),avg(heat),avg(location),avg(atmosphere)  from wingtheory.markers join wingtheory.reviews on markerid = id where address = '1000 E 41st St, Austin, TX 78751, USA'

INSERT INTO wingtheory.reviews VALUES (1, 5, 4, 2, 2, 2, 3, 0, 3, null, null, now());

INSERT INTO wingtheory.reviews VALUES (2, 5, 4, 2, 2, 2, 3, 0, 3, null, null, now());

INSERT INTO reviews VALUES (1, 3, 2, 1, 4, 5, 2, 0, 3, null, null, now());

select * from markers

select id from wingtheory_test.markers where address = '4140 Lemmon Ave Suite 176, Dallas, TX 75219, United States'


 insert into wingtheory_test.markers (lat, lng, name, title, msg, registered_dtts, address) values
  (32.8155824,-96.8093479,'Buffalo Wild Wings','Buffalo Wild Wings','',now(),'$4140 Lemmon Ave Suite 176, Dallas, TX 75219, United States')


drop table wingtheory_test.markers

CREATE TABLE `markers` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `lat` varchar(50) NOT NULL,
  `lng` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `msg` varchar(50) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `registered_dtts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  PRIMARY KEY (`id`)
) 



drop table reviews
CREATE TABLE `reviews` (
  markerid int(6) NOT NULL,
  size int(1) NOT NULL,
  crisp int(1) NOT NULL,
  num_sauce int(1) NOT NULL,
  batter int(1) NOT NULL,
  sauce_quality int(1) NOT NULL,
  sauce_amount int(1) NOT NULL,
  heat int(1) NOT NULL,
  location int(1) NOT NULL,
  atmosphere int(1) NOT NULL,
  review_sauce varchar(200) DEFAULT NULL,
  review_text varchar(2000) DEFAULT NULL,
  registered_dtts timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


insert into reviews (size, num_sauce, sauce_quality, batter, sauce_amount, heat, location, atmosphere, review_text, registered_dtts) values('1','1','1','1','1','0','1','1','',now())
commit;

select * from reviews;


CREATE TABLE `review_summary` (
  markerid int(6) NOT NULL,
  num_reviews int(6) NOT NULL,
  size int(1) NOT NULL,
  crisp int(1) NOT NULL,
  num_sauce int(1) NOT NULL,
  batter int(1) NOT NULL,
  sauce_quality int(1) NOT NULL,
  sauce_amount int(1) NOT NULL,
  heat int(1) NOT NULL,
  location int(1) NOT NULL,
  atmosphere int(1) NOT NULL,
  review_sauce varchar(200) DEFAULT NULL,
  review_text varchar(2000) DEFAULT NULL,
  registered_dtts timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



create table finviz_price_progress (
 detect_date datetime not null,
 category varchar(100) not null,
 ticker varchar(10) not null,
 price_detected FLOAT not null,
 price_current FLOAT,
 recent_detection_count int,
 recent_detection_price FLOAT
 )
 
 
 
 
