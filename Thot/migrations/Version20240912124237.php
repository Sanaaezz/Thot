<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240912124237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_categorie (article_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_934886107294869C (article_id), INDEX IDX_93488610BCF5E72D (categorie_id), PRIMARY KEY(article_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_934886107294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_93488610BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD utilisateur_id INT NOT NULL, ADD style_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BACD6074 FOREIGN KEY (style_id) REFERENCES genre (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66FB88E14F ON article (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66BACD6074 ON article (style_id)');
        $this->addSql('ALTER TABLE commentaire ADD utilisateur_id INT DEFAULT NULL, ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_67F068BCFB88E14F ON commentaire (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_67F068BC7294869C ON commentaire (article_id)');
        $this->addSql('ALTER TABLE utilisateur ADD avoir_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3C36D46DB FOREIGN KEY (avoir_id) REFERENCES avatar (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3C36D46DB ON utilisateur (avoir_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_categorie DROP FOREIGN KEY FK_934886107294869C');
        $this->addSql('ALTER TABLE article_categorie DROP FOREIGN KEY FK_93488610BCF5E72D');
        $this->addSql('DROP TABLE article_categorie');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66FB88E14F');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BACD6074');
        $this->addSql('DROP INDEX IDX_23A0E66FB88E14F ON article');
        $this->addSql('DROP INDEX IDX_23A0E66BACD6074 ON article');
        $this->addSql('ALTER TABLE article DROP utilisateur_id, DROP style_id');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCFB88E14F');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC7294869C');
        $this->addSql('DROP INDEX IDX_67F068BCFB88E14F ON commentaire');
        $this->addSql('DROP INDEX IDX_67F068BC7294869C ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP utilisateur_id, DROP article_id');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3C36D46DB');
        $this->addSql('DROP INDEX IDX_1D1C63B3C36D46DB ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP avoir_id');
    }
}
