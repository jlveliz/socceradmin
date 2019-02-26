<!-- ============ Customizer ============= -->
<div class="customizer">
    <div class="handle" (click)="isOpen = !isOpen">
      <i class="i-Gear spin"></i>
    </div>
    <div class="customizer-body" data-perfect-scrollbar data-suppress-scroll-x="true">
        <div class="accordion" id="accordionCustomizer">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <p class="mb-0">
                       Barra Lateral
                    </p>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionCustomizer">
                    <div class="card-body">
                        <div class="">
                            <a title="Compact" href="{{route('compact')}}" class="btn btn-primary"> Compacto </a>
                            <a title="Normal" href="{{route('normal')}}" class="btn btn-primary"> Normal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============ End Customizer ============= -->
