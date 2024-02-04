import App from "./App";
import { render } from "@wordpress/element";
import ReactDOM from "react-dom/client";

/**
 * Import the stylesheet for the plugin.
 */
import "../dist/output.css";

const root = ReactDOM.createRoot(document.getElementById("jobplace"));
root.render(<App />);
