select avg(size) as size,avg(crisp) as crisp,avg(num_sauce) as num_sauce,avg(sauce_quality) as sauce_quality,avg(sauce_amount) as sauce_amount,avg(heat) as heat,avg(location) as location,avg(atmosphere) as atmosphere  from markers join reviews on markerid = id where address = '4411 Lemmon Ave Ste 100, Dallas, TX 75219, United States'



select * from markers

INSERT INTO reviews VALUES (1, 3, 2, 1, 4, 5, 2, 0, 3, null, null, now());

CREATE TABLE `reviews` (
  markerid int(6) NOT NULL,
  size int(1) NOT NULL,
  crisp int(1) NOT NULL,
  num_sauce int(1) NOT NULL,
  sauce_quality int(1) NOT NULL,
  sauce_amount int(1) NOT NULL,
  heat int(1) NOT NULL,
  location int(1) NOT NULL,
  atmosphere int(1) NOT NULL,
  review_sauce varchar(200) DEFAULT NULL,
  review_text varchar(2000) DEFAULT NULL,
  registered_dtts timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);