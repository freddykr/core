<?php
/**
 * This file is part of cBackup, network equipment configuration backup tool
 * Copyright (C) 2017, Oļegs Čapligins, Imants Černovs, Dmitrijs Galočkins
 *
 * cBackup is free software: you can redistribute it and/or modify it
 * under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @var $this           yii\web\View
 * @var $database       string
 * @var $giturl         string
 */
?>
<div class="row">
    <div class="col-md-3">
        <form style="margin: 0 1em;">
            <label for="path"><?= Yii::t('update', 'Path to your cBackup installation') ?></label>
            <input id="path" type="text" class="form-control" value="<?= Yii::$app->basePath ?>">
        </form>
    </div>
    <div class="col-md-12">
        <hr>
        <ol>
            <li>
                <?= Yii::t('update', 'Backup everything') ?> <br>
                $ <code>tar czf /opt/backup-$(date +%Y-%m-%d).tar.gz -C <span class="path">-C /opt/cbackup</span> .</code>
                <br>
                $ <code>mysqldump -u <?= Yii::$app->db->username ?> -p <?= $database ?> | gzip > /opt/backup-$(date +%Y-%m-%d).sql.gz</code>
                <br><br>
            </li>
            <li>
                <?= Yii::t('update', 'Download the latest update') ?><br>
                $ <code>wget <?= $giturl ?>/archive/update.zip -P /opt</code>
                <br><br>
            </li>
            <li>
                <?= Yii::t('update', 'Create lock file in your cBackup installation folder to enable maintentance mode, blocking access to the interface') ?><br>
                $ <code>touch <span class="path">/opt/cbackup</span>/update.lock</code>
                <br><br>
            </li>
            <li>
                <?= Yii::t('update', 'Stop the service') ?> <br>
                $ <code>sudo systemctl stop cbackup</code>
                <br><br>
            </li>
            <li>
                <?= Yii::t('update', 'Unpack downloaded archive to your cBackup installation overriding all files') ?><br>
                $ <code>unzip -o /opt/update.zip -d <span class="path">/opt/cbackup</span></code>
                <br><br>
            </li>
            <li>
                <?= Yii::t('update', 'Remove archive') ?> <br>
                $ <code>rm /opt/update.zip</code>
                <br><br>
            </li>
            <li>
                <?= Yii::t('update', 'Restore permissions') ?> <br>
                $ <code><span class="path">/opt/cbackup</span>/setPermissions.sh</code>
                <br><br>
            </li>
            <li>
                <?= Yii::t('update', 'Update database') ?> <br>
                $ <code><span class="path">/opt/cbackup</span>/yii migrate</code>
                <br><br>
            </li>
            <li>
                <?= Yii::t('update', 'Start service') ?> <br>
                $ <code>sudo systemctl start cbackup</code>
                <br><br>
            </li>
            <li>
                <?= Yii::t('update', 'Remove lock file') ?> <br>
                $ <code>rm <span class="path">/opt/cbackup</span>/update.lock</code>
            </li>
        </ol>
        <hr>
        <p style="padding: 0 1em;">
            <?= Yii::t('update', 'Now update is finished, check if everything works as it is intended.') ?>
        </p>
    </div>
</div>
