import { BrowserRouter, Route, Routes } from "react-router-dom";
import Login from "./pages/Login";
import Cadastro from "./pages/Cadastro";
import ContaHome from "./pages/ContaHome";

function AppRoutes() {
  return(
    <BrowserRouter>
      <Routes>
        <Route index element={<Login/>}/>
        <Route path='/cadastro' element={<Cadastro/>}/>
        <Route path='/conta' element={<ContaHome/>}/>

      </Routes>    
    </BrowserRouter>
  );

}

export default AppRoutes;
