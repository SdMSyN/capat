/**
 * Author:  GianBros
 * Created: 18/03/2018
 */

ALTER TABLE `totolac_capat`.`contratos` ADD INDEX  (`tipo_contrato_id`);
ALTER TABLE `contratos` ADD FOREIGN KEY (`tipo_contrato_id`) REFERENCES `tipos_contratos`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `totolac_capat`.`cuotas` ADD INDEX (`tipo_servicio_id`);
ALTER TABLE `cuotas` ADD FOREIGN KEY (`comunidad_id`) REFERENCES `comunidades`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `cuotas` ADD FOREIGN KEY (`tipo_servicio_id`) REFERENCES `tipos_servicios`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `totolac_capat`.`pagos` ADD INDEX  (`usuario_data_id`, `tipo_servicio_id`);
ALTER TABLE `pagos` ADD FOREIGN KEY (`tipo_servicio_id`) REFERENCES `tipos_servicios`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `pagos` ADD FOREIGN KEY (`usuario_data_id`) REFERENCES `usuarios_data`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `pagos` ADD `estatus_id` INT NOT NULL AFTER `monto`;
ALTER TABLE `pagos` ADD `ticket` VARCHAR(20) NULL AFTER `estatus_id`;
