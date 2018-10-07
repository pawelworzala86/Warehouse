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

create or replace view debtor_view as
select
uuid, id, added_by, deleted, coalesce(round((select sum(to_pay) from document where contractor_id=contractor.id), 2), 0) as debt,
name, `code`
from
contractor

create or replace view production_view as select
`werhouse`.`production`.`id` AS `id`,`werhouse`.`production`.`uuid` AS `uuid`, production.added_by as added_by,
`werhouse`.`production`.`name` AS `name`,
round(coalesce(sum(if((`werhouse`.`document`.`type` = 'rw'),`werhouse`.`document`.`net`,0)),0),2) AS `buy_net`,
round(coalesce(sum(if((`werhouse`.`document`.`type` = 'pw'),`werhouse`.`document`.`net`,0)),0),2) AS `sell_net`
from ((`werhouse`.`production`
left join `werhouse`.`production_document` on((`werhouse`.`production_document`.`production_id` = `werhouse`.`production`.`id`)))
left join `werhouse`.`document` on((`werhouse`.`document`.`id` = `werhouse`.`production_document`.`document_id`)))
where
(`werhouse`.`production`.`deleted` = 0)
group by
`werhouse`.`production`.`id`


create or replace view cash_document_view as SELECT
cash_document.id, cash_document.uuid, cash_document.number, cash_document.added_by,
cash_document.amount, cash_document.kind, cash_document.added, cash_document.`date`
FROM
cash_document



create or replace view cash_view as SELECT
sum(if(cash_document.kind='kp',amount,0)-if(cash_document.kind='kw',amount,0)) as ballance, added_by
FROM
cash_document
WHERE
added>COALESCE((select added from cash_document as c where c.added_by=cash_document.added_by and c.kind='kz' order by added desc limit 1),0)
group by added_by