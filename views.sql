create or replace view product_file_view as SELECT
file.id as file_id, product_files.id as id, file.uuid as file_uuid, file.added as added, product_files.deleted as deleted,
file.size as size, file.url as url, file.name as name, file.type as type,
product_files.id as product_files_id, product_files.uuid as product_files_uuid,
product_id, product.uuid as product_uuid
FROM product_files
left join file on file.id=product_files.file_id
left join product on product_id=product.id

create or replace view product_attachment_view as SELECT
file.id as file_id, product_attachment.id as id, file.uuid as file_uuid, file.added as added, product_attachment.deleted as deleted,
file.size as size, file.url as url, file.name as name, file.type as type,
product_attachment.id as product_files_id, product_attachment.uuid as product_files_uuid,
product_id, product.uuid as product_uuid
FROM product_attachment
left join file on file.id=product_attachment.file_id
left join product on product_id=product.id

create or replace view stock_view as select
product.id as id, product.`uuid` AS `uuid`,`werhouse`.`stock`.`product_id` AS `product_id`,
sum(`werhouse`.`stock`.`count`) AS `count`,`werhouse`.`stock`.`added_by` AS `added_by`,`werhouse`.`stock`.`deleted` AS `deleted`,
`werhouse`.`product`.`name` AS `name`,`werhouse`.`product`.`sku` AS `sku`, product.sell_net as net, product.vat
from `werhouse`.`stock` left join `werhouse`.`product` on `werhouse`.`product`.`id` = `werhouse`.`stock`.`product_id`
where stock.`deleted`=0
group by `werhouse`.`stock`.`product_id`

create or replace view document_view as
select
document.uuid as uuid, document.id as id, document.name, document.`date`, document.added_by, document.deleted, contractor.name as contractor_name, gross,
contractor.uuid as contractor_id
from document
left join contractor on contractor.id=document.contractor_id