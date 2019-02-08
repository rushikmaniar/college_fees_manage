<div class="card">
    <div class="card-body">
        <table class="display nowrap table table-hover table-striped table-bordered dataTable" id="SiteSettingTable">
            <thead>
            <tr>
                <th>Site Settings  Key</th>
                <th>Site Settings  Value</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($site_settings_data as $row): ?>
                <tr>
                    <!-- Class Code -->
                    <td><?= $row['settings_key'] ?></td>
                    <td><?= $row['settings_value'] ?></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm"
                                    data-container="body" title="Edit User"
                                    onclick="ajaxModel('backoffice/SiteSettings/viewEditSiteSettingModal/<?= $row['row_id'] ?>','Edit Site Settings','modal-lg')">
                                <i class="ti-pencil-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {

        $('#SiteSettingTable').dataTable({
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
</script>