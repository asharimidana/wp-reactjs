import React from "react";
import Product from "./pages/Product";
import Dashboard from "./components/Dashboard";
const App = () => {
	const urlParams = new URLSearchParams(window.location.search);
	if (urlParams.get("page") == "dashboard") {
		return <Dashboard />;
	}
	if (urlParams.get("page") == "product2") {
		return <Product />;
	}
};

export default App;
