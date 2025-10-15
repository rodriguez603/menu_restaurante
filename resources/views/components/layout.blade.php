<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'Menú' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            fondo: '#F4E1D2',
            titulo: '#5C4033',
            acento: '#C37B59',
            secundario: '#8C7A6B',
            verde: '#7B9C48',
            card: '#F8EAE0',
            cardb: '#E3CDBD',
            foto: '#EED9CB',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-fondo text-titulo min-h-screen">
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    {{ $slot }}
  </main>
</body>
</html>
