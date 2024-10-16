<div id="modal-show" class="modal fade" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header" style="border-radius: 12px 12px 0px 0px;">
        <h4 class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body personal-align">
      </div>
    </div>
  </div>
</div>

<div id="modal-edit" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body personal-align">
      </div>
    </div>
  </div>
</div>

<div id="modal-delete" class="modal fade" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <form method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm">Apagar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="modal-banned" class="modal fade" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <form method="GET">
          @csrf
          @method('GET')
          <button type="submit" class="btn btn-danger">Suspender</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="modal-active-acount" class="modal fade" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <form method="GET">
          @csrf
          @method('GET')
          <button type="submit" class="btn btn-info">Ativar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="modal-list" class="modal fade" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<div id="shipping-error" class="modal fade" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header" style="border-radius: 12px 12px 0px 0px;">
        <h4 class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body personal-align">
      </div>
    </div>
  </div>
</div>
