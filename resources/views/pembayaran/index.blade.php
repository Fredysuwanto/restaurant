@extends('layout.main')

@section('title', 'pembayaran')

@section('content')

<style>
  .tabel-kita{
    padding-left: 300px;
    padding-right: 400px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
  }
  th, td {
    padding: 15px;
    text-align: center;
  }
    </style>


<div class="tabel-kita">
  <h2 class="my-6 text-2xl font-semibold text-gray-700">
    Halaman Pembayaran
  </h2>
  @can('create', App\Pembayaran::class)
  <a href="{{route('pembayaran.create')}}" class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Tambah Pembayaran</a>
    @endcan
    
    <div><br>
        <div class="w-full overflow-x-auto">
          <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
              <th class="text-center">No Reservasi</th>
              <th class="text-center">Nama Kasir</th>
              <th class="text-center">Metode Pembayaran</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Jumlah</th>
             <th class="text-center">Total Pesanan</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pembayaran as $item)
        <tr>
          <td class="px-4 py-3 text-center">{{ $item["reservasi"]["no_reservasi"] }}</td>
          <td class="px-4 py-3 text-center">{{ $item["kasir"]["nama"] }}</td>
          <td class="px-4 py-3 text-center">{{ $item["metode"] }}</td>
          <td class="px-4 py-3 text-center">{{ $item["menu"]["harga_menu"] }}</td>
          <td class="px-4 py-3 text-center">{{ $item['jumlah'] }}</td>
          <td class="px-4 py-3 text-center">{{ $item["jumlah"]*$item['menu']['harga_menu']}}</td>
          <td class="px-4 py-3 text-center">
            @can('delete', $item)
            <form action="{{route('pembayaran.destroy', $item["id"])}}" method="post" style="display: inline">
              @method('DELETE')
              @csrf
              <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-red show_confirm" data-name="{{ $item['nama'] }}">Hapus</button>
          </form>
          <a href="{{route('pembayaran.edit', $item["id"])}}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-red">Edit</a>

            @endcan
          </td>
        </tr>
      @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
  <script>
    Swal.fire({
    title: "Good job!",
    text: "{{session('success')}}",
    icon: "success"
    });
  </script>
@endif
<!-- confirm dialog -->
<script type="text/javascript">

     $('.show_confirm').click(function(event) {
          let form =  $(this).closest("form");
          let name = $(this).data("name");
          event.preventDefault();
          Swal.fire({
            title: " Yakin Data ingin hapus?",
            text: "Data tidak bisa di kembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Okayy!"
          })
          .then((willDelete) => {
            if (willDelete.isConfirmed) {
              form.submit();
            }
          });
      });

</script>
@endsection