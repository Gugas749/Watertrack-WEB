package com.grupok.watertrack.fragments.mainactivityfrags.creditsview;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.grupok.watertrack.R;

import java.util.List;

public class RVAdapterCredits extends RecyclerView.Adapter<RVAdapterCredits.ViewHolder> {
    private List<String> credits;

    public RVAdapterCredits(List<String> credits) {
        this.credits = credits;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.rv_row_credits, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        holder.textView.setText(credits.get(position));
    }

    @Override
    public int getItemCount() {
        return credits.size();
    }

    public static class ViewHolder extends RecyclerView.ViewHolder {
        TextView textView;
        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            textView = itemView.findViewById(R.id.text_credit);
        }
    }


}
