<div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">
    <table class='table table-striped' id="tabela">
        <thead>
            <tr style="text-align: center">
                @foreach ($header as $item)
                <th>{{ $item }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)

            <tr style="text-align: center">
                <td style="display:none;">{{ $item->id }}</td>
                @if($tag[0]=='aluno')
                <td>{{ $item->nome }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->curso->nome }}</td>
                <td><select class="form-select">
                        @foreach($item->disciplina as $item)
                        <option value="{{$item->id}}"> {{$item->nome}} </option>
                        @endforeach
                    </select></td>
                @elseif($tag[0]=='professor')
                <td>{{ $item->nome }}</td>
                <td>{{ $item->email }}</td>
                @elseif($tag[0]=='curso')
                <td>{{ $item->nome }}</td>
                @elseif($tag[0]=='disciplina')
                <td>{{ $item->nome }}</td>
                <td>{{ $item->curso->nome }}</td>
                <td>{{ $item->professor->nome }}</td>
                @endif
                <td>
                    <a nohref style="cursor:pointer" onClick="editar('{{$item->id}}')"><img src="{{ asset('img/icons/edit.svg') }}"></a>
                    @if($tag[0]=='aluno')
                    <a nohref style="cursor:pointer" href="{{ route('matricula.index').'?aluno_id='.$item->id}}"><img src="{{ asset('img/icons/settings.svg') }}"></a>
                    @endif
                </td>
            </tr>
            </form>
            @endforeach
        </tbody>
    </table>
</div>