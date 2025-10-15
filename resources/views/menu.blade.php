@php
  // Reparto 5x3: 3 columnas comidas (9 items), 2 columnas bebidas (6 items).
  $FILAS = 3; $COLS_COMIDAS = 3; $COLS_BEBIDAS = 2;
  // Helpers para indexar por fila/columna:
  $idxFood = fn($r,$c)=> $r + $c*$FILAS;
  $idxDrink= fn($r,$c)=> $r + ($c-3)*$FILAS;
@endphp

<x-layout :title="'Menú del Restaurante'">
  <div x-data="{ open:false, item:{} }">
    <h1 class="text-4xl font-extrabold">Menú del Restaurante</h1>
    <p class="text-secundario mt-2">Columnas 1–3: Comidas &nbsp; | &nbsp; Columnas 4–5: Bebidas</p>

    {{-- Grid 5x3 en desktop; en móvil se apilan pero mantenemos orden --}}
    <div class="mt-6 hidden lg:grid grid-cols-5 gap-5">
      @for($r=0; $r<$FILAS; $r++)
        @for($c=0; $c<5; $c++)
          @php
            $isFood = $c < $COLS_COMIDAS;
            if ($isFood) { $i = $idxFood($r,$c); $data = $foods[$i] ?? null; }
            else         { $i = $idxDrink($r,$c); $data = $drinks[$i] ?? null; }
          @endphp
          <div class="bg-card border border-cardb rounded-xl p-4 flex flex-col items-center">
            {{-- FOTO TARJETA (desktop) --}}
            @if(!empty($data?->imagen))
              <img src="{{ asset('images/platillos/'.$data->imagen) }}"
                   alt="{{ $data?->nombre }}"
                   class="w-full h-32 object-cover rounded mb-3">
            @else
              <div class="w-full h-32 bg-foto rounded mb-3 flex items-center justify-center text-secundario">
                Foto
              </div>
            @endif

            <h3 class="font-bold text-center">{{ $data?->nombre }}</h3>
            <div class="text-verde font-bold mt-1">${{ number_format($data?->precio ?? 0,2) }}</div>
            <button
              @click="open=true; item={ id: '{{ $data?->id }}', nombre:'{{ $data?->nombre }}', descripcion:@js($data?->descripcion), ingredientes:@js($data?->ingredientes), precio:'{{ number_format($data?->precio ?? 0,2) }}', imagen:'{{ $data?->imagen }}' }"
              class="mt-3 bg-acento text-white px-4 py-2 rounded hover:opacity-90">
              Ver detalle
            </button>
          </div>
        @endfor
      @endfor
    </div>

    {{-- Versión responsive (móvil/tablet): cards en columnas fluidas --}}
    <div class="lg:hidden grid grid-cols-1 sm:grid-cols-2 gap-5 mt-6">
      @foreach($foods as $f)
        <div class="bg-card border border-cardb rounded-xl p-4 flex flex-col items-center">
          @if(!empty($f->imagen))
            <img src="{{ asset('images/platillos/'.$f->imagen) }}"
                 alt="{{ $f->nombre }}"
                 class="w-full h-32 object-cover rounded mb-3">
          @else
            <div class="w-full h-32 bg-foto rounded mb-3 flex items-center justify-center text-secundario">
              Foto
            </div>
          @endif

          <h3 class="font-bold text-center">{{ $f->nombre }}</h3>
          <div class="text-verde font-bold mt-1">${{ number_format($f->precio,2) }}</div>
          <button
            @click="open=true; item={ id:'{{ $f->id }}', nombre:'{{ $f->nombre }}', descripcion:@js($f->descripcion), ingredientes:@js($f->ingredientes), precio:'{{ number_format($f->precio,2) }}', imagen:'{{ $f->imagen }}' }"
            class="mt-3 bg-acento text-white px-4 py-2 rounded hover:opacity-90">
            Ver detalle
          </button>
        </div>
      @endforeach

      @foreach($drinks as $d)
        <div class="bg-card border border-cardb rounded-xl p-4 flex flex-col items-center">
          @if(!empty($d->imagen))
            <img src="{{ asset('images/platillos/'.$d->imagen) }}"
                 alt="{{ $d->nombre }}"
                 class="w-full h-32 object-cover rounded mb-3">
          @else
            <div class="w-full h-32 bg-foto rounded mb-3 flex items-center justify-center text-secundario">
              Foto
            </div>
          @endif

          <h3 class="font-bold text-center">{{ $d->nombre }}</h3>
          <div class="text-verde font-bold mt-1">${{ number_format($d->precio,2) }}</div>
          <button
            @click="open=true; item={ id:'{{ $d->id }}', nombre:'{{ $d->nombre }}', descripcion:@js($d->descripcion), ingredientes:@js($d->ingredientes), precio:'{{ number_format($d->precio,2) }}', imagen:'{{ $d->imagen }}' }"
            class="mt-3 bg-acento text-white px-4 py-2 rounded hover:opacity-90">
            Ver detalle
          </button>
        </div>
      @endforeach
    </div>

    {{-- MODAL DETALLE --}}
    <div x-show="open" x-transition
         class="fixed inset-0 bg-black/40 flex items-center justify-center p-4 z-50">
      <div @click.away="open=false"
           class="bg-fondo w-full max-w-3xl rounded-xl shadow-xl overflow-hidden">
        <div class="p-6">
          <h2 class="text-3xl font-extrabold" x-text="item.nombre"></h2>

          {{-- FOTO EN MODAL (grande) --}}
          <template x-if="item.imagen">
            <img :src="`{{ asset('images/platillos') }}/${item.imagen}`"
                 alt=""
                 class="w-full h-56 object-cover rounded mt-4">
          </template>
          <template x-if="!item.imagen">
            <div class="w-full h-56 bg-foto rounded mt-4 flex items-center justify-center text-secundario">
              Foto (referencia)
            </div>
          </template>

          <div class="mt-6">
            <h3 class="font-semibold">Descripción</h3>
            <p class="text-titulo/90 mt-1" x-text="item.descripcion"></p>
            <h3 class="font-semibold mt-4">Ingredientes</h3>
            <p class="text-titulo/90 mt-1" x-text="item.ingredientes"></p>
            <div class="text-verde font-extrabold text-2xl mt-6"
                 x-text="`Precio: $${item.precio}`"></div>
          </div>

          <div class="mt-6 flex justify-end">
            <button @click="open=false"
                    class="px-4 py-2 rounded border border-cardb text-titulo hover:bg-card">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </div>
</x-layout>
