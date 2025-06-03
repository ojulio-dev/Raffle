<div>

    <table>

        <thead>

            <tr>

                <th>ID</th>
                <th>Name</th>
                <th></th>

            </tr>

        </thead>

        <tbody>

            @foreach($this->records as $record)
    
                <tr>

                    <td>{{ $record->id }}</td>
                    <td>{{ $record->name }}</td>
                    <td>

                        ...

                    </td>

                </tr>
    
            @endforeach

        </tbody>


    </table>

    {{ $this->records->links() }}

</div>
