import { useState } from "react";
import DropDown from "./dropDown";

export default function search() {
    const perMalam = [
        "Rp. 100.000",
        "Rp. 200.000",
        "Rp. 300.000",
        "Rp. 400.000",
        "Rp. 500.000",
        "Rp. 600.000",
        "Rp. 700.000",
        "Rp. 800.000",
        "Rp. 900.000",
        "Rp. 1.000.000",
    ];
    const [harga, setHarga] = useState(2000000);
    const formatNumber = (num) => {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    };
    return (
        <div className="p-4 bg-red-200 w-full flex flex-col gap-y-4 rounded-lg">
            <h1 className="font-semibold text-3xl self-start mb-2">FILTER</h1>
            <div className="flex gap-x-4 justify-between w-full">
                <DropDown header={"Kota:"} dropDown={perMalam} />
                <DropDown header={"Tgl In:"} dropDown={perMalam} />
                <DropDown header={"Tgl Out:"} dropDown={perMalam} />
                <DropDown header={"Kapasitas:"} dropDown={perMalam} />
            </div>
            <div className="grid grid-cols-7 gap-4 bg-blue-200 w-full px-2 py-1">
                <div className="col-span-2 flex w-full ">
                    <div className="flex flex-col">
                        <label htmlFor="harga">Harga</label>
                        <input
                            type="range"
                            name="harga"
                            id="harga"
                            min={1000000}
                            max={10000000}
                            step={100000}
                            value={harga}
                            onChange={(e) => setHarga(e.target.value)}
                        />
                        <span className="font-semibold text-lg">
                            Rp. {formatNumber(harga)}
                        </span>
                    </div>
                </div>
                <div className="col-span-5 flex w-full">LIST HOTEL</div>
            </div>
        </div>
    );
}
