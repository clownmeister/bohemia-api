<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version99999999999999 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'New fixtures';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
INSERT INTO bohemiadb.role (id, name) VALUES (0x0180DD8AB34BC0B0BFDCC9BDF269C897, 'ROLE_HIERARCHY_VIEW');
INSERT INTO bohemiadb.role (id, name) VALUES (0x0180DD8B0886F15BE9FE0D4983ABCBDF, 'ROLE_HIERARCHY_ADD');
INSERT INTO bohemiadb.role (id, name) VALUES (0x0180DD8B2442D861F8618F035A15ACEC, 'ROLE_HIERARCHY_REMOVE');
INSERT INTO bohemiadb.role (id, name) VALUES (0x0180DD8B5043423818A932B03BE3777C, 'ROLE_HIERARCHY_EDIT');
INSERT INTO bohemiadb.role (id, name) VALUES (0x0180DE036A78C3CCA3E59D0F01500F17, 'ROLE_TRASH_VIEW');
INSERT INTO bohemiadb.role (id, name) VALUES (0x01810CD6680BC0AE0ADD7AFE07C4594B, 'ROLE_CATEGORY_VIEW');
INSERT INTO bohemiadb.role (id, name) VALUES (0x01810CD67C0F25DA21B89F47D75F80CF, 'ROLE_CATEGORY_EDIT');
INSERT INTO bohemiadb.role (id, name) VALUES (0x01810CD68BCB45F2151D532CFC2D0867, 'ROLE_CATEGORY_REMOVE');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB7223B12D65711EC9FB70242AC150004, 'ROLE_USER');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB722AE64D65711EC9FB70242AC150004, 'ROLE_COMMENT_ADD');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB7230DB2D65711EC9FB70242AC150004, 'ROLE_ADMIN');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB7238C31D65711EC9FB70242AC150004, 'ROLE_MODERATOR');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB7240012D65711EC9FB70242AC150004, 'ROLE_COMMENT_VIEW');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB7245694D65711EC9FB70242AC150004, 'ROLE_COMMENT_REMOVE');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB724B168D65711EC9FB70242AC150004, 'ROLE_COMMENT_RESTORE');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB72518E3D65711EC9FB70242AC150004, 'ROLE_POST_VIEW');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB72588CCD65711EC9FB70242AC150004, 'ROLE_POST_ADD');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB725E22BD65711EC9FB70242AC150004, 'ROLE_POST_EDIT');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB7264BEAD65711EC9FB70242AC150004, 'ROLE_POST_REMOVE');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB726C7A6D65711EC9FB70242AC150004, 'ROLE_POST_RESTORE');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB7271FFCD65711EC9FB70242AC150004, 'ROLE_POST_PUBLISH');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB72789A0D65711EC9FB70242AC150004, 'ROLE_USER_VIEW');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB727E113D65711EC9FB70242AC150004, 'ROLE_USER_ADD');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB7286927D65711EC9FB70242AC150004, 'ROLE_USER_EDIT');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB728CB39D65711EC9FB70242AC150004, 'ROLE_USER_REMOVE');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB72926E2D65711EC9FB70242AC150004, 'ROLE_USER_ENABLE');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB7298D6BD65711EC9FB70242AC150004, 'ROLE_USER_DISABLE');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB72A02AFD65711EC9FB70242AC150004, 'ROLE_ROLE_VIEW');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB72A5EDAD65711EC9FB70242AC150004, 'ROLE_ROLE_ADD');
INSERT INTO bohemiadb.role (id, name) VALUES (0xB72AC716D65711EC9FB70242AC150004, 'ROLE_ROLE_REMOVE');
        ");


        $this->addSql("
            INSERT INTO bohemiadb.user (id, firstname, lastname, phone, street, city, state, country, zip, email, username, password, is_verified, created_at) VALUES (0xEFBBBF75756964282900000000000000, 'admin', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 'admin@bohemia.com', 'admin', '$2y$15\$jDaQKhsPcPlnQy3bDecFaePPty1apL1poQAmswJedRI4/AJDxvifC', 1, '2022-05-19 16:19:16');
        ");

        $this->addSql("
           INSERT INTO bohemiadb.user_role (user_id, role_id) VALUES (0xEFBBBF75756964282900000000000000, 0xB7230DB2D65711EC9FB70242AC150004);
        ");


        $this->addSql("
INSERT INTO bohemiadb.role_hierarchy (id, parent_role_id) VALUES (0x0180DD00D89976CCF059FC9CD52A9CD7, 0xB7223B12D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy (id, parent_role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB7230DB2D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy (id, parent_role_id) VALUES (0x0180DD27482A87C183875959EF5FE135, 0xB7238C31D65711EC9FB70242AC150004);
 ");

        $this->addSql("
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD00D89976CCF059FC9CD52A9CD7, 0xB722AE64D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0x0180DD8AB34BC0B0BFDCC9BDF269C897);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0x0180DD8B0886F15BE9FE0D4983ABCBDF);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0x0180DD8B2442D861F8618F035A15ACEC);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0x0180DD8B5043423818A932B03BE3777C);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0x0180DE036A78C3CCA3E59D0F01500F17);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0x01810CD6680BC0AE0ADD7AFE07C4594B);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0x01810CD67C0F25DA21B89F47D75F80CF);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0x01810CD68BCB45F2151D532CFC2D0867);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB722AE64D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB7240012D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB7245694D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB724B168D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB72518E3D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB72588CCD65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB725E22BD65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB7264BEAD65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB726C7A6D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB7271FFCD65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB72789A0D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB727E113D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB7286927D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB728CB39D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB72926E2D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB7298D6BD65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB72A02AFD65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB72A5EDAD65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD055D02337AAAD9771BA6EA0B77, 0xB72AC716D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD27482A87C183875959EF5FE135, 0x0180DE036A78C3CCA3E59D0F01500F17);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD27482A87C183875959EF5FE135, 0xB722AE64D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD27482A87C183875959EF5FE135, 0xB7240012D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD27482A87C183875959EF5FE135, 0xB7245694D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD27482A87C183875959EF5FE135, 0xB724B168D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD27482A87C183875959EF5FE135, 0xB72518E3D65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD27482A87C183875959EF5FE135, 0xB72588CCD65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD27482A87C183875959EF5FE135, 0xB725E22BD65711EC9FB70242AC150004);
INSERT INTO bohemiadb.role_hierarchy_role (role_hierarchy_id, role_id) VALUES (0x0180DD27482A87C183875959EF5FE135, 0xB7271FFCD65711EC9FB70242AC150004);
 ");

        $this->addSql("
            INSERT INTO bohemiadb.post (id, title, slug, html, created_by_id, created_at, edited_at, published, archived, deleted, edited_by_id) VALUES (0x0180D531D7FFCAB7CCCD70114BEA1856, 'Evropa míří k nezávislosti na ruském plynu', 'Evropa-miri-k-nezavislosti-na-ruskem-plynu', '<div class=\"justify-content-center align-items-center d-flex w-100\"><img alt=\"\" src=\"https://prazsky-magazin.cz/wp-content/uploads/2020/09/20200911_123708-e1630392383654.jpg\" style=\"height:275px; width:367px\" /></div>
                <p><strong>Evropsk&aacute; komise dnes představila n&aacute;vrhy na pos&iacute;len&iacute; energetick&eacute; nez&aacute;vislosti Evropy pomoc&iacute; rozvoje obnoviteln&yacute;ch zdrojů a renovace budov. Marian Jurečka (KDU-ČSL), m&iacute;stopředseda vl&aacute;dy a ministr pr&aacute;ce a soci&aacute;ln&iacute;ch věc&iacute; upozorňuje, že naplněn&iacute; strategie bude m&iacute;t pozitivn&iacute; dopady na Česko v podobě dostupn&yacute;ch cen energie a př&iacute;ležitosti pro nov&aacute; pracovn&iacute; m&iacute;sta.</strong></p>
                <p>Ministerstvo pr&aacute;ce a soci&aacute;ln&iacute;ch věc&iacute; (MPSV) ře&scaron;&iacute; v posledn&iacute;ch měs&iacute;c&iacute;ch ochranu dom&aacute;cnost&iacute; před raketově rostouc&iacute;mi cenami energie. Ty tlač&iacute; v Česku i cel&eacute; Evropě zejm&eacute;na rusk&aacute; v&aacute;lka proti Ukrajině a omezen&iacute; dod&aacute;vek zemn&iacute;ho plynu pr&aacute;vě z Ruska.<br />
                <strong>Evropsk&aacute; komise dnes představila strategii postavenou na rozvoji obnoviteln&yacute;ch zdrojů a renovaci budov. To je př&iacute;ležitost i pro Českou republiku. Potřebujeme d&aacute;t sol&aacute;rn&iacute; panely na střechy budov a zjednodu&scaron;it proces schvalov&aacute;n&iacute; nov&yacute;ch projektů. Na MPSV určitě prověř&iacute;me možnosti instalace fotovoltaiky na v&scaron;echny vhodn&eacute; střechy na&scaron;ich &uacute;řadů. Chceme j&iacute;t př&iacute;kladem a uk&aacute;zat, jak&eacute; jsou v&yacute;hody využit&iacute; slunečn&iacute; energie. Pod&iacute;v&aacute;me se i na možnosti využit&iacute; tepeln&yacute;ch čerpadel a &uacute;spor energie v budov&aacute;ch. I st&aacute;t může uk&aacute;zat, jak lze &scaron;etřit na v&yacute;daj&iacute;ch za energie pomoc&iacute; zateplen&iacute; nebo v&yacute;měny oken.</strong></p>
                <p><strong><img alt=\"\" src=\"https://prazsky-magazin.cz/wp-content/uploads/2022/03/plyn-horak-300x200.jpg\" style=\"float:left; margin-right:15px\" /></strong>Je dobr&eacute; si připomenout, že nejlevněj&scaron;&iacute; energie je ta, kterou vůbec nespotřebujeme. To plat&iacute; pro &uacute;ředn&iacute; budovy i ty obytn&eacute;. Dom&aacute;cnost v kvalitně zateplen&eacute;m domě u&scaron;etř&iacute; ročně des&iacute;tky tis&iacute;c korun za energie, kter&eacute; nebude muset nakoupit. Zv&yacute;&scaron;&iacute; se tak&eacute; komfort bydlen&iacute;. Rodin&aacute;m může se zateplen&iacute;m pomoci program, kter&yacute; připravila kolegyně z vl&aacute;dy, ministryně životn&iacute;ho prostřed&iacute; Anna Hub&aacute;čkov&aacute; (za KDU-ČSL): NZ&Uacute; Light nab&iacute;dne finance alespoň pro d&iacute;lč&iacute; stavebn&iacute; &uacute;spory, kter&eacute; lze zvl&aacute;dnout před leto&scaron;n&iacute; zimou. Jen zateplen&iacute; střechy sn&iacute;ž&iacute; spotřebu energie v domě o pětinu.</p>
                <p><strong>Evropsk&aacute; komise podporuje tak&eacute; ře&scaron;en&iacute;, kter&aacute; nahrad&iacute; zemn&iacute; plyn pro vyt&aacute;pěn&iacute; budov. V Česku jsme na tom již začali pracovat: z Kotl&iacute;kov&yacute;ch dotac&iacute;, kter&eacute; podpoř&iacute; v&yacute;měnu star&yacute;ch kotlů, jsme vyřadili podporu kotlů na zemn&iacute; plyn a zv&yacute;&scaron;ili podporu pro tepeln&aacute; čerpadla. D&aacute;le se budeme ve spolupr&aacute;ci s ministerstvem životn&iacute;ho prostřed&iacute; zab&yacute;vat t&iacute;m, jak upravit programy podpory, aby na ni dos&aacute;hlo v&iacute;ce česk&yacute;ch dom&aacute;cnost&iacute;. Rusk&aacute; agrese vedla ke skokov&eacute;mu růstu z&aacute;jmu o program Nov&aacute; zelen&aacute; &uacute;spor&aacute;m. Počet ž&aacute;dost&iacute; na fotovoltaiku jen za prvn&iacute; měs&iacute;ce leto&scaron;n&iacute;ho roku přes&aacute;hl 10 tis&iacute;c, což se už rovn&aacute; počtu žadatelů za cel&yacute; loňsk&yacute; rok.</strong></p>
                <p>&nbsp;</p>
                <p>V&yacute;roba a instalace tepeln&yacute;ch čerpadel, kotlů na biomasu, sol&aacute;rn&iacute;ch kolektorů nebo fotovoltaick&yacute;ch modulů je &scaron;ance i pro česk&yacute; trh pr&aacute;ce. Budeme se rozhodně zab&yacute;vat možnostmi podpory rekvalifikace a vzděl&aacute;v&aacute;n&iacute; tak, aby pracovn&iacute; trh dok&aacute;zal uspokojit hlad po rostouc&iacute; popt&aacute;vce mont&eacute;rů.</p>
                <p>Př&iacute;ležitost vid&iacute;m tak&eacute; v produkci dom&aacute;c&iacute;ho zelen&eacute;ho plynu. Strategie energetick&eacute; bezpečnosti Evropy REPowerEU navrhuje celoevropsk&yacute; c&iacute;l 35 miliard kub&iacute;ků biometanu. Česk&eacute; zemědělstv&iacute; se zde potk&aacute;v&aacute; s energetikou: dom&aacute;c&iacute; bioplynov&eacute; stanice mohou nahradit až 10 % dod&aacute;vek rusk&eacute;ho plynu. Dom&aacute;c&iacute; biometan je dnes levněj&scaron;&iacute; než plyn z Ruska, takže jde opět o v&iacute;tan&yacute; krok, kter&yacute; ve v&yacute;sledku pomůže k dostupn&yacute;m cen&aacute;m energie pro česk&eacute; dom&aacute;cnosti.</p>
                <p>Mgr. Lucie Je&scaron;&aacute;tkov&aacute;</p>', 0xEFBBBF75756964282900000000000000, '2022-05-18 05:24:14', NULL, 1, 0, 0, NULL);
            INSERT INTO bohemiadb.post (id, title, slug, html, created_by_id, created_at, edited_at, published, archived, deleted, edited_by_id) VALUES (0x0180D537A793C635A46B74A16816D77E, 'Malebná náplavka ožije Pražskými vinařskými a rybími slavnostmi', 'Malebna-naplavka-ozije-Prazskymi-vinarskymi-a-rybimi-slavnostmi', '<p><strong>O v&iacute;kendu 10. a 11. června 2022 bude Hořej&scaron;&iacute; n&aacute;břež&iacute; pražsk&eacute; N&aacute;plavky patřit v&scaron;em milovn&iacute;kům skvěl&yacute;ch v&iacute;n a ryb&iacute;ch specialit, a to nejen na tal&iacute;ři. Atmosf&eacute;ra centra Prahy, nejkvalitněj&scaron;&iacute; v&iacute;na od vinařů z&nbsp;česk&eacute; a moravsk&eacute; produkce, gastronomick&eacute; z&aacute;žitky z&nbsp;tradičně i netradičně připraven&yacute;ch ryb a doprovodn&yacute; program pro celou rodinu v&nbsp;pod&aacute;n&iacute; těch nejlep&scaron;&iacute;ch buskers, na to v&scaron;e se mohou n&aacute;v&scaron;těvn&iacute;ci tě&scaron;it. V&scaron;em př&iacute;choz&iacute;m se otevře i řeka Vltava a z&nbsp;jedn&eacute; strany na druhou budou jezdit a přev&aacute;žet z&aacute;jemce lodě a př&iacute;vozy.</strong></p>
                <p><strong><img alt=\"\" src=\"https://prazsky-magazin.cz/wp-content/uploads/2022/05/Image_fotografie-300x200.jpg\" style=\"float:left; margin-right:15px\" /></strong></p>
                <p>Malebn&aacute; sm&iacute;chovsk&aacute; n&aacute;plavka bude v&nbsp;p&aacute;tek 10. června od 13 hodin a v&nbsp;sobotu 11. června od 11 hodin patřit v&scaron;em gurm&aacute;nům. Na sv&eacute; si přijdou v&scaron;ichni, kteř&iacute; si o v&iacute;kendu chtěj&iacute; už&iacute;t zaj&iacute;mav&yacute; program v&nbsp;centru Prahy. A nebude chybět hudba a dobr&eacute; j&iacute;dlo i pit&iacute;. Cel&yacute; program doprovod&iacute; př&iacute;jemn&aacute; a stylov&aacute; hudba v&nbsp;podobě pouličn&iacute;ho uměn&iacute;, tzv. busking. &bdquo;<em>Pracujeme s tradic&iacute; a na&scaron;e slavnosti navazuj&iacute; na Pražsk&eacute; ryb&aacute;řsk&eacute; slavnosti. Kulin&aacute;řům a milovn&iacute;kům gastronomie nemus&iacute;m připom&iacute;nat, že k dobr&eacute; rybě patř&iacute; dobr&eacute; v&iacute;no. Na n&aacute;plavk&aacute;ch se tyto věci snoub&iacute; v jedinečnou harmonii chuťov&yacute;ch prožitků,&ldquo;</em>&nbsp;ř&iacute;k&aacute; dramaturg Pražsk&yacute;ch vinařsk&yacute;ch slavnost&iacute; Jiř&iacute; Vrti&scaron;.</p>
                <p><strong>V&nbsp;př&iacute;jemn&eacute;m prostřed&iacute; ochutn&aacute;te kulin&aacute;řsk&eacute; speciality či netradičně připraven&eacute; ryb&iacute; pochutiny. N&aacute;v&scaron;těvn&iacute;kům se otevře i řeka Vltava, po kter&eacute; je budou přepravovat lodě a př&iacute;voz.</strong></p>
                <p>Vstup na akci je zdarma.</p>
                <p>Partnery akce jsou Hudba na vinic&iacute;ch, Vinn&yacute; ko&scaron;t, Uměn&iacute; v&iacute;na a RedHead music.</p>
                <p>&nbsp;<u><a href=\"https://vinananaplavce.cz/\">https://vinananaplavce.cz/</a></u></p>
                <p>Hana Doležalov&aacute;</p>', 0xEFBBBF75756964282900000000000000, '2022-05-18 05:30:35', NULL, 1, 0, 0, NULL);
            INSERT INTO bohemiadb.post (id, title, slug, html, created_by_id, created_at, edited_at, published, archived, deleted, edited_by_id) VALUES (0x0180D95BEC27F8D810E3628386B69D2A, 'This is testing post', 'This-is-testing-post', '<p>Hello Bohemia, this is my testing post.</p>', 0xEFBBBF75756964282900000000000000, '2022-05-19 00:48:41', NULL, 0, 0, 0, NULL);
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql(/** @lang MySQL */ 'TRUNCATE role');
        $this->addSql(/** @lang MySQL */ 'TRUNCATE user');
        $this->addSql(/** @lang MySQL */ 'TRUNCATE role_hierarchy');
        $this->addSql(/** @lang MySQL */ 'TRUNCATE post');
    }
}
