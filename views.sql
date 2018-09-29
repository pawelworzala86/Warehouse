create or replace view product_file_view as SELECT
file.id as file_id, file.uuid as file_uuid, file.added as added, product_files.deleted as deleted,
file.size as size, file.url as url, file.name as name, file.type as type,
product_files.id as product_files_id, product_files.uuid as product_files_uuid,
product_id, product.uuid as product_uuid
FROM file
left join product_files on file.id=product_files.file_id
left join product on product_id=product.id

create or replace view stock_view as select
`werhouse`.`stock`.`id` AS `id`,`werhouse`.`stock`.`uuid` AS `uuid`,`werhouse`.`stock`.`product_id` AS `product_id`,
sum(`werhouse`.`stock`.`count`) AS `count`,`werhouse`.`stock`.`added_by` AS `added_by`,`werhouse`.`stock`.`deleted` AS `deleted`,
`werhouse`.`product`.`name` AS `name`,`werhouse`.`product`.`sku` AS `sku`
from (`werhouse`.`stock` left join `werhouse`.`product` on((`werhouse`.`product`.`id` = `werhouse`.`stock`.`product_id`)))
group by `werhouse`.`stock`.`product_id`