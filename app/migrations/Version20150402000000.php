<?php
/**
 * @package     Mautic
 * @copyright   2015 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Mautic\CoreBundle\Doctrine\AbstractMauticMigration;

/**
 * Class Version20150402000000
 */
class Version20150402000000 extends AbstractMauticMigration
{
    /**
     * @param Schema $schema
     */
    public function postgresqlUp(Schema $schema)
    {
        $this->addSql('ALTER TABLE ' . $this->prefix . 'emails DROP read_in_browser');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'email_stats DROP CONSTRAINT ' . $this->findPropertyName('email_stats', 'fk', '3DAE168B'));
        $this->addSql('ALTER TABLE ' . $this->prefix . 'email_stats ADD CONSTRAINT ' . $this->generatePropertyName('email_stats', 'fk', array('list_id')) . ' FOREIGN KEY (list_id) REFERENCES ' . $this->prefix . 'lead_lists (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'forms ADD in_kiosk_mode BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'page_hits ALTER referer TYPE TEXT');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'page_hits ALTER url TYPE TEXT');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'page_redirects ALTER url TYPE TEXT');
    }

    /**
     * @param Schema $schema
     */
    public function mysqlUp(Schema $schema)
    {
        $this->addSql('ALTER TABLE ' . $this->prefix . 'emails DROP read_in_browser');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'email_stats DROP FOREIGN KEY ' . $this->findPropertyName('email_stats', 'fk', '3DAE168B'));
        $this->addSql('ALTER TABLE ' . $this->prefix . 'email_stats ADD CONSTRAINT ' . $this->generatePropertyName('email_stats', 'fk', array('list_id')) . ' FOREIGN KEY (list_id) REFERENCES ' . $this->prefix . 'lead_lists (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'forms ADD in_kiosk_mode TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'page_hits CHANGE referer referer LONGTEXT DEFAULT NULL, CHANGE url url LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'page_redirects CHANGE url url LONGTEXT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function mssqlUp(Schema $schema)
    {
        $this->addSql('ALTER TABLE ' . $this->prefix . 'emails DROP COLUMN read_in_browser');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'email_stats DROP CONSTRAINT ' . $this->findPropertyName('email_stats', 'fk', '3DAE168B'));
        $this->addSql('ALTER TABLE ' . $this->prefix . 'email_stats ADD CONSTRAINT ' . $this->generatePropertyName('email_stats', 'fk', array('list_id')) . ' FOREIGN KEY (list_id) REFERENCES ' . $this->prefix . 'lead_lists (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'forms ADD in_kiosk_mode BIT');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'page_hits ALTER COLUMN referer VARCHAR(MAX)');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'page_hits ALTER COLUMN url VARCHAR(MAX)');
        $this->addSql('ALTER TABLE ' . $this->prefix . 'page_redirects ALTER COLUMN url VARCHAR(MAX) NOT NULL');
    }
}
