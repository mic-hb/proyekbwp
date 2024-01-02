import { Card } from "flowbite-react";

export default function card({ image, title, rating, price, action }) {
    return (
        <Card className="w-full" imgSrc={image} horizontal>
            <div className="min-w-max flex flex-col">
                <div className="flex w-full">
                    <h5 className="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {title}
                    </h5>
                </div>
                <div className="flex w-full">
                    <p className="font-normal text-gray-700 dark:text-gray-400">
                        {rating}
                    </p>
                </div>
                <div className="flex w-full">
                    <p className="font-normal text-gray-700 dark:text-gray-400">
                        {price}
                    </p>
                </div>
                <div className="flex w-full">
                    <button
                        type="submit"
                        className="w-full px-2 py-1 bg-green-400 font-semibold rounded-lg"
                    >
                        {action}
                    </button>
                </div>
            </div>
        </Card>
    );
}
