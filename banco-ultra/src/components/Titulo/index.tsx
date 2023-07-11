
interface ITitulo {
  texto: string;
}

export default function Titulo({ texto }: ITitulo){
  return(
    <>
      <h1>{texto}</h1>
    </>
  )

}