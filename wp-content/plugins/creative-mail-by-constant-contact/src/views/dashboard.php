<?php
use CreativeMail\Helpers\EnvironmentHelper;
?>

<script type="application/javascript">
  var ce4wpDashboardUrl = "<?php echo esc_url($this->dashboard_url) ?>";
  var ce4wpActionPerformed = false;
  function ce4wpMarkActionPerformed () { ce4wpActionPerformed = true; }
  function ce4wpNavigateToDashboard(dashboard) {
    if (!ce4wpDashboardUrl) {
      return;
    }
    ce4wpActionPerformed = true;
    window.open(ce4wpDashboardUrl + '&dashboard=' + dashboard, '_blank');
  }
</script>
<div class="ce4wp-admin-wrapper">
    <header class="ce4wp-swoosh-header"></header>

    <div class="ce4wp-swoosh-container">
    <div style="margin-top: 0px;">
      <div class="ce4wp-backdrop">
        <div class="ce4wp-backdrop-container">
          <div class="ce4wp-backdrop-header">
            <div class="ce4wp-logo-poppins"></div>
            <div>
              <img src="<?php echo CE4WP_PLUGIN_URL . 'assets/images/airplane.svg'; ?>" class="ce4wp-airplane" alt="Paper airplane decoration">
            </div>
          </div>

          <div class="ce4wp-card">
            <div class="ce4wp-px-4 ce4wp-pt-4">
              <h1 class="ce4wp-typography-root ce4wp-typography-h1 ce4wp-inline-block ce4wp-mb-3">
                Intelligent email marketing for<br>WordPress and WooCommerce
              </h1>
              <p class="ce4wp-typography-root ce4wp-subtitle ce4wp-mt-4 ce4wp-mb-4">
                You’re all set! Creative Mail and WordPress have been linked.
              </p>
              <div id="loaded">
                <a id='ce4wp-go-button' href="<?php echo esc_url($this->dashboard_url) ?>" target="_blank" class="ce4wp-button-base-root ce4wp-button-root ce4wp-button-contained ce4wp-button-contained-primary ce4wp-mt-2" tabindex="0" type="button" data-element-type="button" onclick="ce4wpMarkActionPerformed();">
                  <span class="ce4wp-button-label" style="width: 100%;">Open your Creative Mail dashboard<span class="ce4wp-button-endIcon">
                    <svg class="ce4wp-Svgicon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                      <path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"></path>
                    </svg>
                    </span>
                  </span>
                </a>
                <h6 id='ce4wp-sub-apps-title' class="ce4wp-typography-root ce4wp-typography-h6 ce4wp-mt-4 ce4wp-mb-3">
                  Or jump straight into:
                </h6>
                <div id='ce4wp-sub-apps-container' class="ce4wp-grid ce4wp-mt-3">
                  <div class="ce4wp-grid-item" onclick="ce4wpNavigateToDashboard('WooCommerceAutomation')">
                    <div class="ce4wp-grid-item-card ce4wp-mb-4">
                      <div class="ce4wp-grid-item-card-media" title="WooCommerce emails" style="background-image: url(<?php echo CE4WP_PLUGIN_URL . 'assets/images/tile-img-woocommerce.svg'; ?>);"></div>
                      <div class="ce4wp-grid-item-card-content-root">
                        <h4 class="ce4wp-typography-root ce4wp-typography-h4">WooCommerce emails</h4>
                        <p class="ce4wp-pt-2 ce4wp-typography-root ce4wp-body2">Spice up your transactional WooCommerce store emails.</p>
                      </div>
                    </div>
                  </div>
                  <div class="ce4wp-grid-item" onclick="ce4wpNavigateToDashboard('LogoMaker')">
                    <div class="ce4wp-grid-item-card ce4wp-mb-4">
                      <div class="ce4wp-grid-item-card-media" title="Logomaker tools" style="background-image: url(<?php echo CE4WP_PLUGIN_URL . 'assets/images/tile-img-logomaker.svg'; ?>);"></div>
                      <div class="ce4wp-grid-item-card-content-root">
                        <h4 class="ce4wp-typography-root ce4wp-typography-h4">Logomaker tools</h4>
                        <p class="ce4wp-pt-2 ce4wp-typography-root ce4wp-body2">Enhance your brand. Design your own logo like a pro.</p>
                      </div>
                    </div>
                  </div>
                  <div class="ce4wp-grid-item" onclick="ce4wpNavigateToDashboard('Contacts')">
                    <div class="ce4wp-grid-item-card ce4wp-mb-4">
                      <div class="ce4wp-grid-item-card-media" title="Contact Management" style="background-image: url(<?php echo CE4WP_PLUGIN_URL . 'assets/images/tile-img-contactmanagement.svg'; ?>);"></div>
                      <div class="ce4wp-grid-item-card-content-root">
                        <h4 class="ce4wp-typography-root ce4wp-typography-h4">Contact Management</h4>
                        <p class="ce4wp-pt-2 ce4wp-typography-root ce4wp-body2">Manage your contacts and email lists, all in one place.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div id="skeleton" style="display: none;">
                <div class="ce4wp-button-base-root ce4wp-button-root ce4wp-button-contained ce4wp-mt-2 skeleton-pulse" style="width: 300px; color: #8C8C8C;">
                  <span class="ce4wp-button-label" style="width: 100%;">Loading your account...</span>
                </div>
                <div class="ce4wp-typography-root ce4wp-typography-h6 ce4wp-mt-4 ce4wp-mb-3 skeleton-pulse ce4wp-subapps-skeleton"></div>
                <div class="ce4wp-grid ce4wp-mt-3">
                  <div class="ce4wp-grid-item" onclick="navigateWooCommerce()">
                    <div class="ce4wp-grid-item-card ce4wp-mb-4">
                      <div class="ce4wp-grid-item-card-media skeleton-pulse ce4wp-grid-item-card-media-skeleton"></div>
                      <div class="ce4wp-grid-item-card-content-root skeleton-pulse">
                        <div class="ce4wp-grid-item-card-content-skeleton-title"></div>
                        <div class="ce4wp-grid-item-card-content-skeleton-description"></div>
                      </div>
                    </div>
                  </div>
                  <div class="ce4wp-grid-item" onclick="navigateLogomaker()">
                    <div class="ce4wp-grid-item-card ce4wp-mb-4">
                      <div class="ce4wp-grid-item-card-media skeleton-pulse ce4wp-grid-item-card-media-skeleton"></div>
                      <div class="ce4wp-grid-item-card-content-root skeleton-pulse">
                        <div class="ce4wp-grid-item-card-content-skeleton-title"></div>
                        <div class="ce4wp-grid-item-card-content-skeleton-description"></div>
                      </div>
                    </div>
                  </div>
                  <div class="ce4wp-grid-item" onclick="navigateContacts()">
                    <div class="ce4wp-grid-item-card ce4wp-mb-4">
                      <div class="ce4wp-grid-item-card-media skeleton-pulse ce4wp-grid-item-card-media-skeleton"></div>
                      <div class="ce4wp-grid-item-card-content-root skeleton-pulse">
                        <div class="ce4wp-grid-item-card-content-skeleton-title"></div>
                        <div class="ce4wp-grid-item-card-content-skeleton-description"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="application/javascript">
  let blurred = false;
  window.onblur = function() {
    if (!ce4wpActionPerformed) {
      return
    }
    blurred = true;
    document.getElementById('skeleton').style.display = "block";
    document.getElementById('loaded').style.display = "none";
    ce4wpDashboardUrl = null
  };
  window.onfocus = function() {
    if (!blurred) {
      return
    }
    fetch(wpApiSettings.root + 'creativemail/v1/sso', {
      headers: {
        'X-WP-Nonce': wpApiSettings.nonce
      },
    }).then(async (r) => {
      const data = await r.json();
      if (data && data.url) {
        ce4wpDashboardUrl = data.url;
        ce4wpActionPerformed = false;
        document.getElementById('skeleton').style.display = "none";
        document.getElementById('loaded').style.display = "block";
      }
    })
  };
</script>
