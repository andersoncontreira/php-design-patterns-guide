CREATE TABLE IF NOT EXISTS store.products (
    id INT NOT NULL AUTO_INCREMENT,
    sku INT(11) NOT NULL,
    uuid VARCHAR(36) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    supplier_id INT(11) NOT NULL,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL,
    deleted_at timestamp NULL,
    PRIMARY KEY (id)
);
