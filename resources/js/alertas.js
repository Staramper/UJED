//ALERTAS SWEEAT ALERT
export function correcto(){
  Swal.fire({
    position: 'center',
    type: 'success',
    title: '¡Todo Correcto, Buen trabajo!',
    showConfirmButton: false,
    timer: 1500
  })
    };

export function error(){
    Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: 'Algo Salio Mal, Lo sentimos',
    })
    };

export function agregarC(){
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
  });
  swalWithBootstrapButtons.fire({
    title: "Producto agregado con exito",
    text: "¿Quieres ver tu carrito",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Ir a mi carrito!",
    cancelButtonText: "Seguir comprando",
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      swalWithBootstrapButtons.fire({
        title: "Deleted!",
        text: "Your file has been deleted.",
        icon: "success"
      });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire({
        title: "Cancelled",
        text: "Your imaginary file is safe :)",
        icon: "error"
      });
    }
  });
}