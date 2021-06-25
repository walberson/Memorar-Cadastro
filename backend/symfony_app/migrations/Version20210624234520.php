<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624234520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_system CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE name name VARCHAR(150) NOT NULL, CHANGE phone phone VARCHAR(15) NOT NULL, CHANGE birth_date birth_date DATETIME NOT NULL, CHANGE email email VARCHAR(150) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE cpf cpf VARCHAR(11) DEFAULT NULL, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_system MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE user_system DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user_system CHANGE id id INT NOT NULL, CHANGE name name TEXT CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE phone phone TEXT CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE birth_date birth_date DATE NOT NULL, CHANGE email email TEXT CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE password password TEXT CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE cpf cpf TEXT CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
    }
}
