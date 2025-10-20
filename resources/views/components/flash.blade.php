@props(["msg", "bg" => "alert-success"])

<div id="site-alert" class="col-7 position-absolute top-1 end-0 mt-4 me-4" style="z-index: 10">
    <div class="alert {{ $bg }} alert-dismissible fade show fw-bold shadow" role="alert">
        {{ $msg }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alertBox = document.getElementById('site-alert');
        if (alertBox) {
            setTimeout(() => {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alertBox.querySelector('.alert'));
                bsAlert.close();
            }, 2000);
        }
    });
</script>
