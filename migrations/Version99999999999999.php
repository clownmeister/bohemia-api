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
INSERT INTO bohemiadb.post (id, created_by_id, edited_by_id, title, description, image_url, slug, html, created_at, edited_at, published, archived, deleted) VALUES (0x0180D531D7FFCAB7CCCD70114BEA1856, 0xEFBBBF75756964282900000000000000, null, 'Evropa m?????? k nez??vislosti na rusk??m plynu', 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla non arcu lacinia neque faucibus fringilla. Nullam faucibus mi quis velit. Pellentesque sapien.', '5b39edcb-ad5b-43c4-a456-622290e63020.jpg', 'Evropa-miri-k-nezavislosti-na-ruskem-plynu', '<div class=\"align-items-center d-flex justify-content-center w-100\"><img alt=\"\" src=\"https://prazsky-magazin.cz/wp-content/uploads/2020/09/20200911_123708-e1630392383654.jpg\" style=\"height:275px; width:367px\" /></div>
<p><strong>Evropsk&aacute; komise dnes p??edstavila n&aacute;vrhy na pos&iacute;len&iacute; energetick&eacute; nez&aacute;vislosti Evropy pomoc&iacute; rozvoje obnoviteln&yacute;ch zdroj?? a renovace budov. Marian Jure??ka (KDU-??SL), m&iacute;stop??edseda vl&aacute;dy a ministr pr&aacute;ce a soci&aacute;ln&iacute;ch v??c&iacute; upozor??uje, ??e napln??n&iacute; strategie bude m&iacute;t pozitivn&iacute; dopady na ??esko v podob?? dostupn&yacute;ch cen energie a p??&iacute;le??itosti pro nov&aacute; pracovn&iacute; m&iacute;sta.</strong></p>
<p>Ministerstvo pr&aacute;ce a soci&aacute;ln&iacute;ch v??c&iacute; (MPSV) ??e&scaron;&iacute; v posledn&iacute;ch m??s&iacute;c&iacute;ch ochranu dom&aacute;cnost&iacute; p??ed raketov?? rostouc&iacute;mi cenami energie. Ty tla??&iacute; v ??esku i cel&eacute; Evrop?? zejm&eacute;na rusk&aacute; v&aacute;lka proti Ukrajin?? a omezen&iacute; dod&aacute;vek zemn&iacute;ho plynu pr&aacute;v?? z Ruska.<br />
<strong>Evropsk&aacute; komise dnes p??edstavila strategii postavenou na rozvoji obnoviteln&yacute;ch zdroj?? a renovaci budov. To je p??&iacute;le??itost i pro ??eskou republiku. Pot??ebujeme d&aacute;t sol&aacute;rn&iacute; panely na st??echy budov a zjednodu&scaron;it proces schvalov&aacute;n&iacute; nov&yacute;ch projekt??. Na MPSV ur??it?? prov????&iacute;me mo??nosti instalace fotovoltaiky na v&scaron;echny vhodn&eacute; st??echy na&scaron;ich &uacute;??ad??. Chceme j&iacute;t p??&iacute;kladem a uk&aacute;zat, jak&eacute; jsou v&yacute;hody vyu??it&iacute; slune??n&iacute; energie. Pod&iacute;v&aacute;me se i na mo??nosti vyu??it&iacute; tepeln&yacute;ch ??erpadel a &uacute;spor energie v budov&aacute;ch. I st&aacute;t m????e uk&aacute;zat, jak lze &scaron;et??it na v&yacute;daj&iacute;ch za energie pomoc&iacute; zateplen&iacute; nebo v&yacute;m??ny oken.</strong></p>
<p><strong><img alt=\"\" src=\"https://prazsky-magazin.cz/wp-content/uploads/2022/03/plyn-horak-300x200.jpg\" style=\"float:left; margin-right:15px\" /></strong>Je dobr&eacute; si p??ipomenout, ??e nejlevn??j&scaron;&iacute; energie je ta, kterou v??bec nespot??ebujeme. To plat&iacute; pro &uacute;??edn&iacute; budovy i ty obytn&eacute;. Dom&aacute;cnost v kvalitn?? zateplen&eacute;m dom?? u&scaron;et??&iacute; ro??n?? des&iacute;tky tis&iacute;c korun za energie, kter&eacute; nebude muset nakoupit. Zv&yacute;&scaron;&iacute; se tak&eacute; komfort bydlen&iacute;. Rodin&aacute;m m????e se zateplen&iacute;m pomoci program, kter&yacute; p??ipravila kolegyn?? z vl&aacute;dy, ministryn?? ??ivotn&iacute;ho prost??ed&iacute; Anna Hub&aacute;??kov&aacute; (za KDU-??SL): NZ&Uacute; Light nab&iacute;dne finance alespo?? pro d&iacute;l??&iacute; stavebn&iacute; &uacute;spory, kter&eacute; lze zvl&aacute;dnout p??ed leto&scaron;n&iacute; zimou. Jen zateplen&iacute; st??echy sn&iacute;??&iacute; spot??ebu energie v dom?? o p??tinu.</p>
<p><strong>Evropsk&aacute; komise podporuje tak&eacute; ??e&scaron;en&iacute;, kter&aacute; nahrad&iacute; zemn&iacute; plyn pro vyt&aacute;p??n&iacute; budov. V ??esku jsme na tom ji?? za??ali pracovat: z Kotl&iacute;kov&yacute;ch dotac&iacute;, kter&eacute; podpo??&iacute; v&yacute;m??nu star&yacute;ch kotl??, jsme vy??adili podporu kotl?? na zemn&iacute; plyn a zv&yacute;&scaron;ili podporu pro tepeln&aacute; ??erpadla. D&aacute;le se budeme ve spolupr&aacute;ci s ministerstvem ??ivotn&iacute;ho prost??ed&iacute; zab&yacute;vat t&iacute;m, jak upravit programy podpory, aby na ni dos&aacute;hlo v&iacute;ce ??esk&yacute;ch dom&aacute;cnost&iacute;. Rusk&aacute; agrese vedla ke skokov&eacute;mu r??stu z&aacute;jmu o program Nov&aacute; zelen&aacute; &uacute;spor&aacute;m. Po??et ??&aacute;dost&iacute; na fotovoltaiku jen za prvn&iacute; m??s&iacute;ce leto&scaron;n&iacute;ho roku p??es&aacute;hl 10 tis&iacute;c, co?? se u?? rovn&aacute; po??tu ??adatel?? za cel&yacute; lo??sk&yacute; rok.</strong></p>
<p>&nbsp;</p>
<p>V&yacute;roba a instalace tepeln&yacute;ch ??erpadel, kotl?? na biomasu, sol&aacute;rn&iacute;ch kolektor?? nebo fotovoltaick&yacute;ch modul?? je &scaron;ance i pro ??esk&yacute; trh pr&aacute;ce. Budeme se rozhodn?? zab&yacute;vat mo??nostmi podpory rekvalifikace a vzd??l&aacute;v&aacute;n&iacute; tak, aby pracovn&iacute; trh dok&aacute;zal uspokojit hlad po rostouc&iacute; popt&aacute;vce mont&eacute;r??.</p>
<p>P??&iacute;le??itost vid&iacute;m tak&eacute; v produkci dom&aacute;c&iacute;ho zelen&eacute;ho plynu. Strategie energetick&eacute; bezpe??nosti Evropy REPowerEU navrhuje celoevropsk&yacute; c&iacute;l 35 miliard kub&iacute;k?? biometanu. ??esk&eacute; zem??d??lstv&iacute; se zde potk&aacute;v&aacute; s energetikou: dom&aacute;c&iacute; bioplynov&eacute; stanice mohou nahradit a?? 10 % dod&aacute;vek rusk&eacute;ho plynu. Dom&aacute;c&iacute; biometan je dnes levn??j&scaron;&iacute; ne?? plyn z Ruska, tak??e jde op??t o v&iacute;tan&yacute; krok, kter&yacute; ve v&yacute;sledku pom????e k dostupn&yacute;m cen&aacute;m energie pro ??esk&eacute; dom&aacute;cnosti.</p>
<p>Mgr. Lucie Je&scaron;&aacute;tkov&aacute;</p>', '2022-05-18 05:24:14', '2022-05-29 01:05:49', 1, 0, 0);
INSERT INTO bohemiadb.post (id, created_by_id, edited_by_id, title, description, image_url, slug, html, created_at, edited_at, published, archived, deleted) VALUES (0x0180D537A793C635A46B74A16816D77E, 0xEFBBBF75756964282900000000000000, null, 'Malebn?? n??plavka o??ije Pra??sk??mi vina??sk??mi a ryb??mi slavnostmi', 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla non arcu lacinia neque faucibus fringilla. Nullam faucibus mi quis velit. Pellentesque sapien.', '2a5e91b7-4dc1-43d7-8c0c-d0762bc0dc4a.webp', 'Malebna-naplavka-ozije-Prazskymi-vinarskymi-a-rybimi-slavnostmi', '<p><strong>O v&iacute;kendu 10. a 11. ??ervna 2022 bude Ho??ej&scaron;&iacute; n&aacute;b??e??&iacute; pra??sk&eacute; N&aacute;plavky pat??it v&scaron;em milovn&iacute;k??m skv??l&yacute;ch v&iacute;n a ryb&iacute;ch specialit, a to nejen na tal&iacute;??i. Atmosf&eacute;ra centra Prahy, nejkvalitn??j&scaron;&iacute; v&iacute;na od vina???? z&nbsp;??esk&eacute; a moravsk&eacute; produkce, gastronomick&eacute; z&aacute;??itky z&nbsp;tradi??n?? i netradi??n?? p??ipraven&yacute;ch ryb a doprovodn&yacute; program pro celou rodinu v&nbsp;pod&aacute;n&iacute; t??ch nejlep&scaron;&iacute;ch buskers, na to v&scaron;e se mohou n&aacute;v&scaron;t??vn&iacute;ci t??&scaron;it. V&scaron;em p??&iacute;choz&iacute;m se otev??e i ??eka Vltava a z&nbsp;jedn&eacute; strany na druhou budou jezdit a p??ev&aacute;??et z&aacute;jemce lod?? a p??&iacute;vozy.</strong></p>
<p><strong><img alt=\"\" src=\"https://prazsky-magazin.cz/wp-content/uploads/2022/05/Image_fotografie-300x200.jpg\" style=\"float:left; margin-right:15px\" /></strong></p>
<p>Malebn&aacute; sm&iacute;chovsk&aacute; n&aacute;plavka bude v&nbsp;p&aacute;tek 10. ??ervna od 13 hodin a v&nbsp;sobotu 11. ??ervna od 11 hodin pat??it v&scaron;em gurm&aacute;n??m. Na sv&eacute; si p??ijdou v&scaron;ichni, kte??&iacute; si o v&iacute;kendu cht??j&iacute; u??&iacute;t zaj&iacute;mav&yacute; program v&nbsp;centru Prahy. A nebude chyb??t hudba a dobr&eacute; j&iacute;dlo i pit&iacute;. Cel&yacute; program doprovod&iacute; p??&iacute;jemn&aacute; a stylov&aacute; hudba v&nbsp;podob?? pouli??n&iacute;ho um??n&iacute;, tzv. busking. &bdquo;<em>Pracujeme s tradic&iacute; a na&scaron;e slavnosti navazuj&iacute; na Pra??sk&eacute; ryb&aacute;??sk&eacute; slavnosti. Kulin&aacute;????m a milovn&iacute;k??m gastronomie nemus&iacute;m p??ipom&iacute;nat, ??e k dobr&eacute; ryb?? pat??&iacute; dobr&eacute; v&iacute;no. Na n&aacute;plavk&aacute;ch se tyto v??ci snoub&iacute; v jedine??nou harmonii chu??ov&yacute;ch pro??itk??,&ldquo;</em>&nbsp;??&iacute;k&aacute; dramaturg Pra??sk&yacute;ch vina??sk&yacute;ch slavnost&iacute; Ji??&iacute; Vrti&scaron;.</p>
<p><strong>V&nbsp;p??&iacute;jemn&eacute;m prost??ed&iacute; ochutn&aacute;te kulin&aacute;??sk&eacute; speciality ??i netradi??n?? p??ipraven&eacute; ryb&iacute; pochutiny. N&aacute;v&scaron;t??vn&iacute;k??m se otev??e i ??eka Vltava, po kter&eacute; je budou p??epravovat lod?? a p??&iacute;voz.</strong></p>
<p>Vstup na akci je zdarma.</p>
<p>Partnery akce jsou Hudba na vinic&iacute;ch, Vinn&yacute; ko&scaron;t, Um??n&iacute; v&iacute;na a RedHead music.</p>
<p>&nbsp;<u><a href=\"https://vinananaplavce.cz/\">https://vinananaplavce.cz/</a></u></p>
<p>Hana Dole??alov&aacute;</p>', '2022-05-18 05:30:35', '2022-05-29 01:05:59', 1, 0, 0);
INSERT INTO bohemiadb.post (id, created_by_id, edited_by_id, title, description, image_url, slug, html, created_at, edited_at, published, archived, deleted) VALUES (0x0180D95BEC27F8D810E3628386B69D2A, 0xEFBBBF75756964282900000000000000, null, 'This is testing post', null, null, 'This-is-testing-post', '<p>Hello Bohemia, this is my testing post.</p>', '2022-05-19 00:48:41', '2022-05-29 01:05:14', 0, 0, 0);
INSERT INTO bohemiadb.post (id, created_by_id, edited_by_id, title, description, image_url, slug, html, created_at, edited_at, published, archived, deleted) VALUES (0x01810CEA0AC5638F7837E789D2252195, 0xEFBBBF75756964282900000000000000, null, 'Devlog 32 - DayZ', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam quis nulla. Curabitur ligula sapien, pulvinar a vestibulum quis, facilisis vel sapien. Sed ac dolor sit amet purus malesuada congue. Fusce nibh. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem.', '4a5460fc-4c96-44d7-b271-7ee7a5c3dab3.jpg', 'Devlog-32-DayZ', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam quis nulla. Curabitur ligula sapien, pulvinar a vestibulum quis, facilisis vel sapien. Sed ac dolor sit amet purus malesuada congue. Fusce nibh. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla non arcu lacinia neque faucibus fringilla. Nullam faucibus mi quis velit. Pellentesque sapien. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Morbi scelerisque luctus velit. Phasellus et lorem id felis nonummy placerat. Quisque porta. Nunc auctor. Nullam faucibus mi quis velit.</p>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam quis nulla. Curabitur ligula sapien, pulvinar a vestibulum quis, facilisis vel sapien. Sed ac dolor sit amet purus malesuada congue. Fusce nibh. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla non arcu lacinia neque faucibus fringilla. Nullam faucibus mi quis velit. Pellentesque sapien. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Morbi scelerisque luctus velit. Phasellus et lorem id felis nonummy placerat. Quisque porta. Nunc auctor. Nullam faucibus mi quis velit.</p>', '2022-05-29 01:04:33', '2022-05-29 01:06:08', 1, 0, 0);
        ");

        $this->addSql("
INSERT INTO bohemiadb.post_category (id, name) VALUES (0x01810CE4F94268C149450CBC91DD31F9, 'General');
INSERT INTO bohemiadb.post_category (id, name) VALUES (0x01810CE50D48C3E0E82995C17ACD981B, 'Devlogs');
INSERT INTO bohemiadb.post_category (id, name) VALUES (0x01810CE516A5A70EA67BFC012E3EB543, 'Tutorials');
INSERT INTO bohemiadb.post_category (id, name) VALUES (0x01810CE51FF316A41105C802E3B367E7, 'Promo');
        ");

        $this->addSql("
INSERT INTO bohemiadb.post_category_post (post_category_id, post_id) VALUES (0x01810CE4F94268C149450CBC91DD31F9, 0x0180D531D7FFCAB7CCCD70114BEA1856);
INSERT INTO bohemiadb.post_category_post (post_category_id, post_id) VALUES (0x01810CE4F94268C149450CBC91DD31F9, 0x0180D537A793C635A46B74A16816D77E);
INSERT INTO bohemiadb.post_category_post (post_category_id, post_id) VALUES (0x01810CE4F94268C149450CBC91DD31F9, 0x0180D95BEC27F8D810E3628386B69D2A);
INSERT INTO bohemiadb.post_category_post (post_category_id, post_id) VALUES (0x01810CE4F94268C149450CBC91DD31F9, 0x01810CEA0AC5638F7837E789D2252195);
INSERT INTO bohemiadb.post_category_post (post_category_id, post_id) VALUES (0x01810CE50D48C3E0E82995C17ACD981B, 0x01810CEA0AC5638F7837E789D2252195);
INSERT INTO bohemiadb.post_category_post (post_category_id, post_id) VALUES (0x01810CE516A5A70EA67BFC012E3EB543, 0x0180D95BEC27F8D810E3628386B69D2A);
INSERT INTO bohemiadb.post_category_post (post_category_id, post_id) VALUES (0x01810CE51FF316A41105C802E3B367E7, 0x0180D531D7FFCAB7CCCD70114BEA1856);
INSERT INTO bohemiadb.post_category_post (post_category_id, post_id) VALUES (0x01810CE51FF316A41105C802E3B367E7, 0x0180D537A793C635A46B74A16816D77E);
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql(/** @lang MySQL */ 'TRUNCATE comment');
        $this->addSql(/** @lang MySQL */ 'TRUNCATE user');
        $this->addSql(/** @lang MySQL */ 'TRUNCATE user_role');
        $this->addSql(/** @lang MySQL */ 'TRUNCATE role');
        $this->addSql(/** @lang MySQL */ 'TRUNCATE role_hierarchy');
        $this->addSql(/** @lang MySQL */ 'TRUNCATE role_hierarchy_role');
        $this->addSql(/** @lang MySQL */ 'TRUNCATE post');
        $this->addSql(/** @lang MySQL */ 'TRUNCATE post_category');
        $this->addSql(/** @lang MySQL */ 'TRUNCATE post_category_post');
    }
}
