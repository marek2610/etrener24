<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200529133714 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE zawodnik CHANGE pesel pesel VARCHAR(11) DEFAULT NULL, CHANGE miejsce_urodzenia miejsce_urodzenia VARCHAR(255) DEFAULT NULL, CHANGE adres adres VARCHAR(255) DEFAULT NULL, CHANGE kod_pocztowy kod_pocztowy VARCHAR(255) DEFAULT NULL, CHANGE miejscowosc miejscowosc VARCHAR(255) DEFAULT NULL, CHANGE poczta poczta VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE telefon telefon VARCHAR(255) DEFAULT NULL, CHANGE noga noga VARCHAR(255) DEFAULT NULL, CHANGE szkola szkola VARCHAR(255) DEFAULT NULL, CHANGE wzrost wzrost INT DEFAULT NULL, CHANGE waga waga INT DEFAULT NULL, CHANGE pozycja pozycja VARCHAR(255) DEFAULT NULL, CHANGE grupa_krwi grupa_krwi VARCHAR(255) DEFAULT NULL, CHANGE pierwszy_klub pierwszy_klub VARCHAR(255) DEFAULT NULL, CHANGE numer_na_koszulce numer_na_koszulce VARCHAR(255) DEFAULT NULL, CHANGE nr_karty_zawodnika nr_karty_zawodnika VARCHAR(255) DEFAULT NULL, CHANGE data_waznosci_karty data_waznosci_karty DATETIME DEFAULT NULL, CHANGE data_rejestracji_wklubie data_rejestracji_wklubie DATETIME DEFAULT NULL, CHANGE imie_rodzica imie_rodzica VARCHAR(255) DEFAULT NULL, CHANGE naziwsko_rodzica naziwsko_rodzica VARCHAR(255) DEFAULT NULL, CHANGE email_rodzica email_rodzica VARCHAR(255) DEFAULT NULL, CHANGE nr_telefonu_rodzica nr_telefonu_rodzica VARCHAR(255) DEFAULT NULL, CHANGE data_utworzenia data_utworzenia DATETIME DEFAULT NULL, CHANGE data_modyfikacji data_modyfikacji DATETIME DEFAULT NULL, CHANGE druzyna druzyna VARCHAR(11) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE zawodnik CHANGE druzyna druzyna VARCHAR(11) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE pesel pesel VARCHAR(11) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE miejsce_urodzenia miejsce_urodzenia VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adres adres VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE kod_pocztowy kod_pocztowy VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE miejscowosc miejscowosc VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE poczta poczta VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE telefon telefon VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE noga noga VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE szkola szkola VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE wzrost wzrost INT DEFAULT NULL, CHANGE waga waga INT DEFAULT NULL, CHANGE pozycja pozycja VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE grupa_krwi grupa_krwi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE pierwszy_klub pierwszy_klub VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE numer_na_koszulce numer_na_koszulce VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE nr_karty_zawodnika nr_karty_zawodnika VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE data_waznosci_karty data_waznosci_karty DATETIME DEFAULT \'NULL\', CHANGE data_rejestracji_wklubie data_rejestracji_wklubie DATETIME DEFAULT \'NULL\', CHANGE imie_rodzica imie_rodzica VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE naziwsko_rodzica naziwsko_rodzica VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE email_rodzica email_rodzica VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE nr_telefonu_rodzica nr_telefonu_rodzica VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE data_utworzenia data_utworzenia DATETIME DEFAULT \'NULL\', CHANGE data_modyfikacji data_modyfikacji DATETIME DEFAULT \'NULL\'');
    }
}
