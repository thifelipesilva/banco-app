import { Link } from "react-router-dom";
import Titulo from "../Titulo";

export default function Menu(){

    const rotas = [
        {
            label: 'Home',
            to: '/conta'
        },
        {
            label: 'Deposito',
            to: '/conta'
        },
        {
            label: 'Transferênciia',
            to: '/conta'
        }
    ];



    return(
      <header className="flex items-center justify-between">
        <Titulo texto="Banco-App"/>
        <nav className="flex items-center justify-between">
            <ul>
              {
                rotas.map((rota, index) => (
                    <li key={index}>
                      <Link to={rota.to}>
                        {rota.label}
                      </Link>  
                    </li>
                ))
              }
            </ul>
        </nav>
        <p>Sair</p>
      </header>
    )
  
  }